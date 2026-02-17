@extends('layouts.app')
@section('title','Order #'.$order->order_number)
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
<h4 class="fw-bold mb-0"><i class="bi bi-bag-check me-2"></i>Order Details</h4>
<a href="{{ route('order.history') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back to Orders</a>
</div>
<div class="row g-4">
<div class="col-md-8">
{{-- Tracking --}}
<div class="card border-0 shadow-sm mb-3">
<div class="card-body">
<h6 class="fw-bold mb-3"><i class="bi bi-truck me-2"></i>Order Tracking — <code>{{ $order->order_number }}</code></h6>
@php $steps = ['pending'=>'Receipt','processing'=>'Processing','shipped'=>'Shipped','delivered'=>'Delivered'];
$reached = false; @endphp
<div class="d-flex justify-content-between">
@foreach($steps as $key=>$label)
@php $active = in_array($order->status, array_keys(array_slice($steps,0,array_search($key,array_keys($steps))+1))); @endphp
<div class="text-center flex-fill">
<div class="rounded-circle d-inline-flex align-items-center justify-content-center {{ $active?'bg-success text-white':'bg-light text-muted' }}" style="width:44px;height:44px;font-size:1.1rem">
<i class="bi bi-{{ $key=='pending'?'receipt':($key=='processing'?'gear':($key=='shipped'?'truck':'house-check')) }}"></i>
</div>
<div class="small mt-1 fw-semibold {{ $active?'text-success':'' }}">{{ $label }}</div>
</div>
@if(!$loop->last)<div class="flex-fill d-flex align-items-center" style="margin-top:-20px"><hr class="w-100 {{ $active?'border-success':'' }}"></div>@endif
@endforeach
</div>
</div>
</div>
{{-- Items --}}
<div class="card border-0 shadow-sm">
<div class="card-body">
<h6 class="fw-bold mb-3">Items Ordered</h6>
@foreach($order->orderItems as $item)
<div class="d-flex align-items-center gap-3 mb-3">
<img src="{{ $item->product->image ? Storage::url($item->product->image) : 'https://via.placeholder.com/60?text=P' }}"
     width="60" height="60" style="object-fit:cover;border-radius:8px">
<div class="flex-grow-1">
<div class="fw-semibold">{{ $item->product->name }}</div>
<small class="text-muted">Qty: {{ $item->quantity }} × ${{ number_format($item->price,2) }}</small>
</div>
<div class="fw-bold">${{ number_format($item->subtotal,2) }}</div>
</div>
@endforeach
<hr>
<div class="d-flex justify-content-between fw-bold fs-5"><span>Total</span><span>${{ number_format($order->total_amount,2) }}</span></div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="card border-0 shadow-sm mb-3">
<div class="card-body">
<h6 class="fw-bold mb-3">Order Info</h6>
<dl class="row mb-0 small">
<dt class="col-5">Order #</dt><dd class="col-7"><code>{{ $order->order_number }}</code></dd>
<dt class="col-5">Date</dt><dd class="col-7">{{ $order->created_at->format('M d, Y') }}</dd>
<dt class="col-5">Status</dt><dd class="col-7"><span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></dd>
<dt class="col-5">Payment</dt><dd class="col-7"><span class="badge {{ $order->payment_status=='success'?'bg-success':'bg-danger' }}">{{ ucfirst($order->payment_status) }}</span></dd>
<dt class="col-5">Method</dt><dd class="col-7">{{ str_replace('_',' ',ucfirst($order->payment_method)) }}</dd>
</dl>
</div>
</div>
<div class="card border-0 shadow-sm">
<div class="card-body">
<h6 class="fw-bold mb-3">Shipping Address</h6>
<p class="mb-0 small text-muted">
{{ $order->shipping_address }}<br>
{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}
</p>
</div>
</div>
</div>
</div>
@endsection
