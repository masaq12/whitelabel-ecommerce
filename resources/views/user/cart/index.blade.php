@extends('layouts.app')
@section('title','Shopping Cart')
@section('content')
<h4 class="fw-bold mb-4"><i class="bi bi-cart3 me-2"></i>Shopping Cart</h4>
@if($carts->isEmpty())
<div class="text-center py-5">
<i class="bi bi-cart-x display-1 text-muted"></i>
<h5 class="mt-3 text-muted">Your cart is empty</h5>
<a href="{{ route('home') }}" class="btn btn-primary mt-2"><i class="bi bi-arrow-left me-2"></i>Continue Shopping</a>
</div>
@else
<div class="row g-4">
<div class="col-lg-8">
<div class="card border-0 shadow-sm">
<div class="card-body p-0">
<table class="table mb-0">
<thead><tr><th>Product</th><th class="text-center">Price</th><th class="text-center">Qty</th><th class="text-center">Subtotal</th><th></th></tr></thead>
<tbody>
@foreach($carts as $item)
<tr>
<td>
<div class="d-flex align-items-center gap-3">
<img src="{{ $item->product->image ? Storage::url($item->product->image) : 'https://via.placeholder.com/60?text=P' }}"
     width="60" height="60" style="object-fit:cover;border-radius:8px">
<div>
<div class="fw-semibold">{{ $item->product->name }}</div>
<small class="text-muted">SKU: {{ $item->product->sku }}</small>
</div>
</div>
</td>
<td class="text-center align-middle">${{ number_format($item->price,2) }}</td>
<td class="text-center align-middle" style="width:130px">
<form action="{{ route('cart.update',$item->id) }}" method="POST" class="d-flex align-items-center justify-content-center gap-1">
@csrf
<input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
       class="form-control form-control-sm text-center" style="width:65px"
       onchange="this.form.submit()">
</form>
</td>
<td class="text-center align-middle fw-bold">${{ number_format($item->getSubtotal(),2) }}</td>
<td class="text-center align-middle">
<form action="{{ route('cart.remove',$item->id) }}" method="POST">
@csrf @method('DELETE')
<button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
<a href="{{ route('home') }}" class="btn btn-outline-secondary mt-3"><i class="bi bi-arrow-left me-2"></i>Continue Shopping</a>
</div>
<div class="col-lg-4">
<div class="card border-0 shadow-sm">
<div class="card-body">
<h5 class="fw-bold mb-3">Order Summary</h5>
<div class="d-flex justify-content-between mb-2"><span>Subtotal</span><span>${{ number_format($total,2) }}</span></div>
<div class="d-flex justify-content-between mb-2"><span>Shipping</span><span class="text-success">Free</span></div>
<hr>
<div class="d-flex justify-content-between fw-bold fs-5"><span>Total</span><span>${{ number_format($total,2) }}</span></div>
<a href="{{ route('checkout') }}" class="btn btn-primary w-100 mt-3 py-2">
<i class="bi bi-credit-card me-2"></i>Proceed to Checkout
</a>
</div>
</div>
</div>
</div>
@endif
@endsection
