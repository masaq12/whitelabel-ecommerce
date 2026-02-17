<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        $total = $carts->sum(fn($c) => $c->getSubtotal());
        return view('user.cart.index', compact('carts', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if (!$product->is_active) {
            return back()->with('error', 'Product is not available.');
        }

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Insufficient stock. Available: ' . $product->stock);
        }

        $cart = Cart::where('user_id', auth()->id())
                    ->where('product_id', $request->product_id)
                    ->first();

        if ($cart) {
            $newQty = $cart->quantity + $request->quantity;
            if ($product->stock < $newQty) {
                return back()->with('error', 'Insufficient stock.');
            }
            $cart->update(['quantity' => $newQty]);
        } else {
            Cart::create([
                'user_id'    => auth()->id(),
                'product_id' => $request->product_id,
                'quantity'   => $request->quantity,
                'price'      => $product->getDisplayPrice(),
            ]);
        }

        return back()->with('success', '"' . $product->name . '" added to cart!');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $cart = Cart::where('user_id', auth()->id())->findOrFail($id);

        if ($cart->product->stock < $request->quantity) {
            return back()->with('error', 'Insufficient stock.');
        }

        $cart->update(['quantity' => $request->quantity]);

        if ($request->ajax()) {
            $carts = Cart::with('product')->where('user_id', auth()->id())->get();
            $total = $carts->sum(fn($c) => $c->getSubtotal());
            return response()->json(['success' => true, 'total' => number_format($total, 2)]);
        }

        return back()->with('success', 'Cart updated.');
    }

    public function remove($id)
    {
        $cart = Cart::where('user_id', auth()->id())->findOrFail($id);
        $cart->delete();

        return back()->with('success', 'Item removed from cart.');
    }
}
