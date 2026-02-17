@extends('layouts.app')
@section('title','My Orders')
@section('content')
<h4 class="fw-bold mb-4"><i class="bi bi-bag me-2"></i>Order History</h4>
@if($orders->isEmpty())
<div class="text-center py-5">
<i class="bi bi-bag-x display-1 text-muted"></i>
<h5 class="mt-3 text-muted">No orders yet</h5>
<a href="{{ route('home') }}" class="btn btn-primary mt-2">Start Shopping</a>
</div>
@else
<div class="card border-0 shadow-sm">
<div class="table-responsive">
<table class="table mb-0">
<thead><tr><th>Order #</th><th>Date</th><th>Total</th><th>Payment</th><th>Status</th><th>Action</th></tr></thead>
<tbody>
@foreach($orders as $order)
<tr>
<td><code>{{ $order->order_number }}</code></td>
<td>{{ $order->created_at->format('M d, Y') }}</td>
<td>${{ number_format($order->total_amount,2) }}</td>
<td>
<span class="badge {{ $order->payment_status=='success'?'bg-success':($order->payment_status=='failed'?'bg-danger':'bg-warning text-dark') }}">
{{ ucfirst($order->payment_status) }}
</span>
</td>
<td><span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
<td><a href="{{ route('order.show',$order->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a></td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
<div class="mt-3">{{ $orders->links() }}</div>
@endif
@endsection
