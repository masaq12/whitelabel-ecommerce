@extends('layouts.app')
@section('title','My Dashboard')
@section('content')
<h4 class="fw-bold mb-4"><i class="bi bi-speedometer2 me-2"></i>My Dashboard</h4>
<div class="row g-3 mb-4">
<div class="col-sm-4">
<div class="card border-0 shadow-sm text-center p-3">
<div class="fs-1 text-primary"><i class="bi bi-bag-check"></i></div>
<div class="fs-3 fw-bold">{{ $totalOrders }}</div>
<div class="text-muted small">Total Orders</div>
</div>
</div>
<div class="col-sm-4">
<div class="card border-0 shadow-sm text-center p-3">
<div class="fs-1 text-success"><i class="bi bi-person-check"></i></div>
<div class="fw-bold">{{ $user->name }}</div>
<div class="text-muted small">{{ $user->email }}</div>
</div>
</div>
<div class="col-sm-4">
<div class="card border-0 shadow-sm text-center p-3">
<a href="{{ route('user.profile') }}" class="text-decoration-none">
<div class="fs-1 text-warning"><i class="bi bi-gear"></i></div>
<div class="fw-bold text-dark">Edit Profile</div>
<div class="text-muted small">Update your info</div>
</a>
</div>
</div>
</div>
<h5 class="fw-bold mb-3">Recent Orders</h5>
@if($recentOrders->isEmpty())
<div class="alert alert-light border">No orders yet. <a href="{{ route('home') }}">Start shopping!</a></div>
@else
<div class="card border-0 shadow-sm">
<table class="table mb-0">
<thead><tr><th>Order #</th><th>Date</th><th>Total</th><th>Status</th><th></th></tr></thead>
<tbody>
@foreach($recentOrders as $order)
<tr>
<td><code>{{ $order->order_number }}</code></td>
<td>{{ $order->created_at->format('M d, Y') }}</td>
<td>${{ number_format($order->total_amount,2) }}</td>
<td><span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
<td><a href="{{ route('order.show',$order->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a></td>
</tr>
@endforeach
</tbody>
</table>
</div>
<a href="{{ route('order.history') }}" class="btn btn-outline-primary mt-3 btn-sm">View All Orders</a>
@endif
@endsection
