@extends('layouts.admin')
@section('title','Products')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
<form method="GET" class="d-flex gap-2">
<input type="text" name="search" class="form-control form-control-sm" placeholder="Search..." value="{{ request('search') }}" style="width:200px">
<select name="category" class="form-select form-select-sm" style="width:160px">
<option value="">All Categories</option>
@foreach($categories as $cat)
<option value="{{ $cat->id }}" {{ request('category')==$cat->id?'selected':'' }}>{{ $cat->name }}</option>
@endforeach
</select>
<button class="btn btn-outline-secondary btn-sm"><i class="bi bi-search"></i></button>
</form>
<a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus me-1"></i>Add Product</a>
</div>
<div class="card border-0 shadow-sm">
<div class="table-responsive">
<table class="table mb-0 align-middle">
<thead><tr><th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Status</th><th>Actions</th></tr></thead>
<tbody>
@forelse($products as $p)
<tr>
<td><img src="{{ $p->image ? Storage::url($p->image) : 'https://via.placeholder.com/50?text=P' }}" width="50" height="50" style="object-fit:cover;border-radius:6px"></td>
<td><div class="fw-semibold">{{ $p->name }}</div><small class="text-muted">{{ $p->sku }}</small></td>
<td>{{ $p->category->name }}</td>
<td>
@if($p->sale_price)
<div class="text-danger fw-bold">${{ number_format($p->sale_price,2) }}</div>
<small class="text-muted text-decoration-line-through">${{ number_format($p->price,2) }}</small>
@else
<div class="fw-bold">${{ number_format($p->price,2) }}</div>
@endif
</td>
<td><span class="badge {{ $p->stock>10?'bg-success':($p->stock>0?'bg-warning text-dark':'bg-danger') }}">{{ $p->stock }}</span></td>
<td><span class="badge {{ $p->is_active?'bg-success':'bg-secondary' }}">{{ $p->is_active?'Active':'Inactive' }}</span></td>
<td>
<a href="{{ route('admin.products.edit',$p) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
<form action="{{ route('admin.products.destroy',$p) }}" method="POST" class="d-inline">
@csrf @method('DELETE')
<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this product?')"><i class="bi bi-trash"></i></button>
</form>
</td>
</tr>
@empty
<tr><td colspan="7" class="text-center text-muted py-4">No products found.</td></tr>
@endforelse
</tbody>
</table>
</div>
</div>
<div class="mt-3">{{ $products->links() }}</div>
@endsection
