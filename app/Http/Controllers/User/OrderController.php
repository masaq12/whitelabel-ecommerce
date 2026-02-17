<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $carts->sum(fn($c) => $c->getSubtotal());
        $user  = auth()->user();

        return view('user.orders.checkout', compact('carts', 'total', 'user'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'shipping_city'    => 'required|string',
            'shipping_state'   => 'required|string',
            'shipping_zip'     => 'required|string',
            'payment_method'   => 'required|in:cash_on_delivery,credit_card,debit_card',
        ]);

        $carts = Cart::with('product')->where('user_id', auth()->id())->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Validate stock
        foreach ($carts as $item) {
            if ($item->product->stock < $item->quantity) {
                return back()->with('error', "Insufficient stock for: {$item->product->name}");
            }
        }

        DB::beginTransaction();
        try {
            $total = $carts->sum(fn($c) => $c->getSubtotal());

            $order = Order::create([
                'user_id'          => auth()->id(),
                'order_number'     => Order::generateOrderNumber(),
                'total_amount'     => $total,
                'status'           => 'pending',
                'payment_status'   => 'pending',
                'payment_method'   => $request->payment_method,
                'shipping_address' => $request->shipping_address,
                'shipping_city'    => $request->shipping_city,
                'shipping_state'   => $request->shipping_state,
                'shipping_zip'     => $request->shipping_zip,
                'notes'            => $request->notes,
            ]);

            foreach ($carts as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->price,
                    'subtotal'   => $item->getSubtotal(),
                ]);
                Product::where('id', $item->product_id)->decrement('stock', $item->quantity);
            }

            // Simulate payment (demo)
            $paymentSuccess       = rand(0, 9) > 2; // 70% success rate
            $order->payment_status = $paymentSuccess ? 'success' : 'failed';
            $order->status         = $paymentSuccess ? 'processing' : 'pending';
            $order->save();

            if ($paymentSuccess) {
                Cart::where('user_id', auth()->id())->delete();
            }

            DB::commit();

            return redirect()->route('order.confirmation', $order->order_number)
                             ->with($paymentSuccess ? 'success' : 'error',
                                    $paymentSuccess ? 'Order placed successfully!' : 'Payment failed. Please try again.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function confirmation($orderNumber)
    {
        $order = Order::with('orderItems.product')
                      ->where('order_number', $orderNumber)
                      ->where('user_id', auth()->id())
                      ->firstOrFail();

        return view('user.orders.confirmation', compact('order'));
    }

    public function history()
    {
        $orders = Order::where('user_id', auth()->id())
                       ->orderBy('created_at', 'desc')
                       ->paginate(10);

        return view('user.orders.history', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('orderItems.product')
                      ->where('user_id', auth()->id())
                      ->findOrFail($id);

        return view('user.orders.show', compact('order'));
    }
}
