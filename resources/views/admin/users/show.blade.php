@extends('layouts.admin')
@section('title', $user->name)
@section('content')
<a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm mb-4"><i class="bi bi-arrow-left me-1"></i>Back</a>
<div class="row g-4">
<div class="col-md-4">
<div class="card border-0 shadow-sm">
<div class="card-body text-center">
<div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:80px;height:80px;font-size:2rem">
<i class="bi bi-person text-muted"></i></div>
<h5 class="fw-bold">{{ $user->name }}</h5>
<p class="text-muted mb-1">{{ $user->email }}</p>
<p class="text-muted small mb-3">{{ $user->phone ?? 'No phone' }}</p>
<p class="text-muted small">Joined {{ $user->created_at->format('M d, Y') }}</p>
</div>
</div>
</div>
<div class="col-md-8">
<div class="card border-0 shadow-sm">
<div class="card-body">
<h6 class="fw-bold mb-3">Order History</h6>
@if($user->orders->isEmpty())
<p class="text-muted">No orders yet.</p>
@else
<table class="table table-sm">
<thead><tr><th>Order #</th><th>Total</th><th>Status</th><th>Date</th></tr></thead>
<tbody>
@foreach($user->orders as $order)
<tr>
<td><code>{{ $order->order_number }}</code></td>
<td>${{ number_format($order->total_amount,2) }}</td>
<td><span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
<td>{{ $order->created_at->format('M d, Y') }}</td>
</tr>
@endforeach
</tbody>
</table>
@endif
</div>
</div>
</div>
</div>
@endsection
