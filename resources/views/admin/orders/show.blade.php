@extends('layouts.admin')
@section('title','Order #'.$order->order_number)
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
<a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<div class="row g-4">
<div class="col-md-8">
<div class="card border-0 shadow-sm mb-3">
<div class="card-body">
<h6 class="fw-bold mb-3">Update Order Status</h6>
<form method="POST" action="{{ route('admin.orders.status',$order) }}" class="d-flex gap-2">
@csrf
<select name="status" class="form-select form-select-sm" style="width:200px">
@foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
<option value="{{ $s }}" {{ $order->status==$s?'selected':'' }}>{{ ucfirst($s) }}</option>
@endforeach
</select>
<button class="btn btn-primary btn-sm"><i class="bi bi-check me-1"></i>Update</button>
</form>
</div>
</div>
<div class="card border-0 shadow-sm">
<div class="card-body">
<h6 class="fw-bold mb-3">Order Items</h6>
<table class="table">
<thead><tr><th>Product</th><th class="text-center">Qty</th><th class="text-center">Price</th><th class="text-end">Subtotal</th></tr></thead>
<tbody>
@foreach($order->orderItems as $item)
<tr>
<td>
<div class="d-flex align-items-center gap-2">
<img src="{{ $item->product->image ? Storage::url($item->product->image) : 'https://via.placeholder.com/40?text=P' }}" width="40" height="40" style="object-fit:cover;border-radius:4px">
<span>{{ $item->product->name }}</span>
</div>
</td>
<td class="text-center">{{ $item->quantity }}</td>
<td class="text-center">${{ number_format($item->price,2) }}</td>
<td class="text-end fw-semibold">${{ number_format($item->subtotal,2) }}</td>
</tr>
@endforeach
</tbody>
<tfoot>
<tr><td colspan="3" class="text-end fw-bold">Total</td><td class="text-end fw-bold fs-6">${{ number_format($order->total_amount,2) }}</td></tr>
</tfoot>
</table>
</div>
</div>
</div>
<div class="col-md-4">
<div class="card border-0 shadow-sm mb-3">
<div class="card-body">
<h6 class="fw-bold mb-3">Order Info</h6>
<dl class="row mb-0 small">
<dt class="col-5">Order #</dt><dd class="col-7"><code>{{ $order->order_number }}</code></dd>
<dt class="col-5">Date</dt><dd class="col-7">{{ $order->created_at->format('M d, Y H:i') }}</dd>
<dt class="col-5">Status</dt><dd class="col-7"><span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></dd>
<dt class="col-5">Payment</dt><dd class="col-7"><span class="badge {{ $order->payment_status=='success'?'bg-success':'bg-danger' }}">{{ ucfirst($order->payment_status) }}</span></dd>
<dt class="col-5">Method</dt><dd class="col-7">{{ str_replace('_',' ',ucfirst($order->payment_method)) }}</dd>
</dl>
</div>
</div>
<div class="card border-0 shadow-sm mb-3">
<div class="card-body">
<h6 class="fw-bold mb-3">Customer</h6>
<p class="mb-1 fw-semibold">{{ $order->user->name }}</p>
<p class="mb-1 small text-muted">{{ $order->user->email }}</p>
<p class="mb-0 small text-muted">{{ $order->user->phone }}</p>
</div>
</div>
<div class="card border-0 shadow-sm">
<div class="card-body">
<h6 class="fw-bold mb-3">Shipping Address</h6>
<p class="mb-0 small text-muted">
{{ $order->shipping_address }}<br>
{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}
</p>
@if($order->notes)<p class="mt-2 mb-0 small"><strong>Notes:</strong> {{ $order->notes }}</p>@endif
</div>
</div>
</div>
</div>
@endsection
