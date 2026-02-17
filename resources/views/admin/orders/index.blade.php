@extends('layouts.admin')
@section('title','Orders')
@section('content')
<form method="GET" class="d-flex gap-2 mb-3">
<input type="text" name="search" class="form-control form-control-sm" placeholder="Order number..." value="{{ request('search') }}" style="width:200px">
<select name="status" class="form-select form-select-sm" style="width:160px" onchange="this.form.submit()">
<option value="">All Statuses</option>
@foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
<option value="{{ $s }}" {{ request('status')==$s?'selected':'' }}>{{ ucfirst($s) }}</option>
@endforeach
</select>
<button class="btn btn-outline-secondary btn-sm"><i class="bi bi-search"></i></button>
</form>
<div class="card border-0 shadow-sm">
<div class="table-responsive">
<table class="table mb-0">
<thead><tr><th>Order #</th><th>Customer</th><th>Total</th><th>Payment</th><th>Status</th><th>Date</th><th></th></tr></thead>
<tbody>
@forelse($orders as $order)
<tr>
<td><code>{{ $order->order_number }}</code></td>
<td>{{ $order->user->name }}</td>
<td>${{ number_format($order->total_amount,2) }}</td>
<td><span class="badge {{ $order->payment_status=='success'?'bg-success':($order->payment_status=='failed'?'bg-danger':'bg-warning text-dark') }}">{{ ucfirst($order->payment_status) }}</span></td>
<td><span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
<td>{{ $order->created_at->format('M d, Y') }}</td>
<td><a href="{{ route('admin.orders.show',$order) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a></td>
</tr>
@empty
<tr><td colspan="7" class="text-center text-muted py-4">No orders found.</td></tr>
@endforelse
</tbody>
</table>
</div>
</div>
<div class="mt-3">{{ $orders->links() }}</div>
@endsection
