@extends('layouts.app')
@section('title','Order Confirmation')
@section('content')
<div class="text-center py-4">
@if($order->payment_status === 'success')
<div class="display-1 text-success mb-3"><i class="bi bi-check-circle-fill"></i></div>
<h3 class="fw-bold text-success">Order Placed Successfully!</h3>
<p class="text-muted">Thank you for your purchase. Your order number is:</p>
<h4 class="fw-bold text-primary mb-4"><code>{{ $order->order_number }}</code></h4>
@else
<div class="display-1 text-danger mb-3"><i class="bi bi-x-circle-fill"></i></div>
<h3 class="fw-bold text-danger">Payment Failed</h3>
<p class="text-muted">Your order was created but payment was not successful. Please try again.</p>
<div class="mb-4">
<a href="{{ route('checkout') }}" class="btn btn-primary me-2">Try Again</a>
<a href="{{ route('home') }}" class="btn btn-outline-secondary">Continue Shopping</a>
</div>
@endif
</div>

<div class="row justify-content-center">
<div class="col-md-8">
<div class="card border-0 shadow-sm mb-3">
<div class="card-body">
<div class="row text-center mb-3">
<div class="col-3">
<div class="rounded-circle d-inline-flex align-items-center justify-content-center bg-{{ in_array($order->status,['pending','processing','shipped','delivered'])?'success':'light' }} text-white" style="width:48px;height:48px;font-size:1.3rem"><i class="bi bi-receipt"></i></div>
<div class="small mt-1 fw-semibold">Pending</div>
</div>
<div class="col-3">
<div class="rounded-circle d-inline-flex align-items-center justify-content-center bg-{{ in_array($order->status,['processing','shipped','delivered'])?'success':'light' }} text-white" style="width:48px;height:48px;font-size:1.3rem"><i class="bi bi-gear"></i></div>
<div class="small mt-1 fw-semibold">Processing</div>
</div>
<div class="col-3">
<div class="rounded-circle d-inline-flex align-items-center justify-content-center bg-{{ in_array($order->status,['shipped','delivered'])?'success':'light' }} text-white" style="width:48px;height:48px;font-size:1.3rem"><i class="bi bi-truck"></i></div>
<div class="small mt-1 fw-semibold">Shipped</div>
</div>
<div class="col-3">
<div class="rounded-circle d-inline-flex align-items-center justify-content-center bg-{{ $order->status=='delivered'?'success':'light' }} text-white" style="width:48px;height:48px;font-size:1.3rem"><i class="bi bi-house-check"></i></div>
<div class="small mt-1 fw-semibold">Delivered</div>
</div>
</div>
<hr>
<h6 class="fw-bold mb-3">Order Items</h6>
@foreach($order->orderItems as $item)
<div class="d-flex justify-content-between mb-2">
<span>{{ $item->product->name }} × {{ $item->quantity }}</span>
<span>${{ number_format($item->subtotal,2) }}</span>
</div>
@endforeach
<hr>
<div class="d-flex justify-content-between fw-bold"><span>Total</span><span>${{ number_format($order->total_amount,2) }}</span></div>
</div>
</div>
<div class="text-center">
<a href="{{ route('order.history') }}" class="btn btn-outline-primary me-2"><i class="bi bi-bag me-2"></i>View Orders</a>
<a href="{{ route('home') }}" class="btn btn-primary"><i class="bi bi-shop me-2"></i>Continue Shopping</a>
</div>
</div>
</div>
@endsection
