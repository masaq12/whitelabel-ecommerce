@extends('layouts.app')
@section('title','Checkout')
@section('content')
<h4 class="fw-bold mb-4"><i class="bi bi-credit-card me-2"></i>Checkout</h4>
<form method="POST" action="{{ route('order.place') }}">
@csrf
<div class="row g-4">
<div class="col-lg-7">
<div class="card border-0 shadow-sm mb-3">
<div class="card-body">
<h5 class="fw-bold mb-3">Shipping Address</h5>
<div class="row g-3">
<div class="col-12">
<label class="form-label">Street Address *</label>
<input type="text" name="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror"
       value="{{ old('shipping_address', $user->address) }}" required>
@error('shipping_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-md-5">
<label class="form-label">City *</label>
<input type="text" name="shipping_city" class="form-control @error('shipping_city') is-invalid @enderror"
       value="{{ old('shipping_city', $user->city) }}" required>
@error('shipping_city')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-md-4">
<label class="form-label">State *</label>
<input type="text" name="shipping_state" class="form-control @error('shipping_state') is-invalid @enderror"
       value="{{ old('shipping_state', $user->state) }}" required>
@error('shipping_state')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-md-3">
<label class="form-label">ZIP *</label>
<input type="text" name="shipping_zip" class="form-control @error('shipping_zip') is-invalid @enderror"
       value="{{ old('shipping_zip', $user->zip_code) }}" required>
@error('shipping_zip')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-12">
<label class="form-label">Notes</label>
<textarea name="notes" class="form-control" rows="2" placeholder="Special delivery instructions...">{{ old('notes') }}</textarea>
</div>
</div>
</div>
</div>
<div class="card border-0 shadow-sm">
<div class="card-body">
<h5 class="fw-bold mb-3">Payment Method</h5>
<div class="row g-2">
<div class="col-12">
<div class="form-check border rounded-2 p-3 mb-2 @if(old('payment_method','cash_on_delivery')=='cash_on_delivery') border-primary @endif">
<input class="form-check-input" type="radio" name="payment_method" id="cod" value="cash_on_delivery" {{ old('payment_method','cash_on_delivery')=='cash_on_delivery'?'checked':'' }}>
<label class="form-check-label fw-semibold" for="cod"><i class="bi bi-cash-coin me-2 text-success"></i>Cash on Delivery</label>
</div>
<div class="form-check border rounded-2 p-3 mb-2">
<input class="form-check-input" type="radio" name="payment_method" id="cc" value="credit_card" {{ old('payment_method')=='credit_card'?'checked':'' }}>
<label class="form-check-label fw-semibold" for="cc"><i class="bi bi-credit-card me-2 text-primary"></i>Credit Card <span class="badge bg-warning text-dark">Demo</span></label>
</div>
<div class="form-check border rounded-2 p-3">
<input class="form-check-input" type="radio" name="payment_method" id="dc" value="debit_card" {{ old('payment_method')=='debit_card'?'checked':'' }}>
<label class="form-check-label fw-semibold" for="dc"><i class="bi bi-bank me-2 text-info"></i>Debit Card <span class="badge bg-warning text-dark">Demo</span></label>
</div>
</div>
<div class="alert alert-info mt-3 mb-0 small">
<i class="bi bi-info-circle me-2"></i><strong>Demo Mode:</strong> This is a simulated payment system. No real charges will be made.
</div>
</div>
</div>
</div>
<div class="col-lg-5">
<div class="card border-0 shadow-sm sticky-top" style="top:20px">
<div class="card-body">
<h5 class="fw-bold mb-3">Order Summary</h5>
@foreach($carts as $item)
<div class="d-flex justify-content-between mb-2 small">
<span>{{ $item->product->name }} × {{ $item->quantity }}</span>
<span>${{ number_format($item->getSubtotal(),2) }}</span>
</div>
@endforeach
<hr>
<div class="d-flex justify-content-between mb-2"><span>Subtotal</span><span>${{ number_format($total,2) }}</span></div>
<div class="d-flex justify-content-between mb-2 text-success"><span>Shipping</span><span>Free</span></div>
<hr>
<div class="d-flex justify-content-between fw-bold fs-5 mb-3"><span>Total</span><span>${{ number_format($total,2) }}</span></div>
<button type="submit" class="btn btn-success w-100 py-2 fw-semibold">
<i class="bi bi-lock-fill me-2"></i>Place Order – ${{ number_format($total,2) }}
</button>
<a href="{{ route('cart.index') }}" class="btn btn-outline-secondary w-100 mt-2">Back to Cart</a>
</div>
</div>
</div>
</div>
</form>
@endsection
