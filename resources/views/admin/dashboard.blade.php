@extends('layouts.admin')
@section('title','Dashboard')
@section('content')
<div class="row g-3 mb-4">
<div class="col-sm-6 col-xl-3">
<div class="card stat-card"><div class="card-body d-flex align-items-center gap-3">
<div class="icon-box bg-primary bg-opacity-10"><i class="bi bi-people-fill text-primary"></i></div>
<div><div class="fs-4 fw-bold">{{ $stats['total_users'] }}</div><div class="text-muted small">Total Users</div></div>
</div></div>
</div>
<div class="col-sm-6 col-xl-3">
<div class="card stat-card"><div class="card-body d-flex align-items-center gap-3">
<div class="icon-box bg-success bg-opacity-10"><i class="bi bi-box-seam text-success"></i></div>
<div><div class="fs-4 fw-bold">{{ $stats['total_products'] }}</div><div class="text-muted small">Total Products</div></div>
</div></div>
</div>
<div class="col-sm-6 col-xl-3">
<div class="card stat-card"><div class="card-body d-flex align-items-center gap-3">
<div class="icon-box bg-warning bg-opacity-10"><i class="bi bi-bag-check text-warning"></i></div>
<div><div class="fs-4 fw-bold">{{ $stats['total_orders'] }}</div><div class="text-muted small">Total Orders</div></div>
</div></div>
</div>
<div class="col-sm-6 col-xl-3">
<div class="card stat-card"><div class="card-body d-flex align-items-center gap-3">
<div class="icon-box bg-info bg-opacity-10"><i class="bi bi-currency-dollar text-info"></i></div>
<div><div class="fs-4 fw-bold">${{ number_format($stats['total_revenue'],2) }}</div><div class="text-muted small">Revenue</div></div>
</div></div>
</div>
</div>

<div class="row g-3 mb-4">
@foreach(['pending'=>'warning','processing'=>'info','shipped'=>'primary','delivered'=>'success'] as $status=>$color)
<div class="col-6 col-md-3">
<div class="card border-0 shadow-sm text-center p-3">
<div class="fs-3 fw-bold text-{{ $color }}">{{ $stats[$status.'_orders'] }}</div>
<div class="text-muted small">{{ ucfirst($status) }}</div>
</div>
</div>
@endforeach
</div>

<div class="card border-0 shadow-sm">
<div class="card-body">
<h6 class="fw-bold mb-3">Recent Orders</h6>
<div class="table-responsive">
<table class="table">
<thead><tr><th>Order #</th><th>Customer</th><th>Amount</th><th>Status</th><th>Date</th><th></th></tr></thead>
<tbody>
@foreach($recent_orders as $order)
<tr>
<td><code>{{ $order->order_number }}</code></td>
<td>{{ $order->user->name }}</td>
<td>${{ number_format($order->total_amount,2) }}</td>
<td><span class="badge badge-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
<td>{{ $order->created_at->format('M d, Y') }}</td>
<td><a href="{{ route('admin.orders.show',$order) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a></td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
@endsection
