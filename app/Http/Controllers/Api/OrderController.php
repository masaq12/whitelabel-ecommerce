<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('orderItems.product')
                       ->where('user_id', $request->user()->id)
                       ->orderBy('created_at', 'desc')
                       ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string',
            'shipping_state' => 'required|string',
            'shipping_zip' => 'required|string',
            'payment_method' => 'required|in:cash_on_delivery,credit_card,debit_card',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Get cart items
        $cartItems = Cart::with('product')
                         ->where('user_id', $request->user()->id)
                         ->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Cart is empty'
            ], 400);
        }

        // Check stock availability
        foreach ($cartItems as $item) {
            if ($item->product->stock < $item->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => "Insufficient stock for {$item->product->name}"
                ], 400);
            }
        }

        DB::beginTransaction();
        try {
            // Calculate total
            $total = $cartItems->sum(function($item) {
                return $item->getSubtotal();
            });

            // Create order
            $order = Order::create([
                'user_id' => $request->user()->id,
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $total,
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => $request->payment_method,
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_state' => $request->shipping_state,
                'shipping_zip' => $request->shipping_zip,
                'notes' => $request->notes,
            ]);

            // Create order items and update stock
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'subtotal' => $item->getSubtotal(),
                ]);

                // Update product stock
                $product = Product::find($item->product_id);
                $product->stock -= $item->quantity;
                $product->save();
            }

            // Simulate payment
            $paymentSuccess = rand(0, 1) == 1; // 50% success rate for demo
            $order->payment_status = $paymentSuccess ? 'success' : 'failed';
            $order->status = $paymentSuccess ? 'processing' : 'pending';
            $order->save();

            // Clear cart if payment successful
            if ($paymentSuccess) {
                Cart::where('user_id', $request->user()->id)->delete();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => $paymentSuccess ? 'Order placed successfully' : 'Payment failed, please try again',
                'data' => $order->load('orderItems.product')
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Order placement failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Request $request, $id)
    {
        $order = Order::with('orderItems.product')
                      ->where('user_id', $request->user()->id)
                      ->find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $order
        ], 200);
    }

    public function track(Request $request, $orderNumber)
    {
        $order = Order::with('orderItems.product')
                      ->where('order_number', $orderNumber)
                      ->where('user_id', $request->user()->id)
                      ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'order' => $order,
                'tracking' => [
                    'pending' => true,
                    'processing' => in_array($order->status, ['processing', 'shipped', 'delivered']),
                    'shipped' => in_array($order->status, ['shipped', 'delivered']),
                    'delivered' => $order->status === 'delivered',
                ]
            ]
        ], 200);
    }
}
