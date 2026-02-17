@extends('layouts.admin')
@section('title','Categories')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
<span class="text-muted small">{{ $categories->total() }} categories</span>
<a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus me-1"></i>Add Category</a>
</div>
<div class="card border-0 shadow-sm">
<div class="table-responsive">
<table class="table mb-0">
<thead><tr><th>#</th><th>Name</th><th>Slug</th><th>Products</th><th>Status</th><th>Actions</th></tr></thead>
<tbody>
@forelse($categories as $cat)
<tr>
<td class="text-muted">{{ $cat->id }}</td>
<td class="fw-semibold">{{ $cat->name }}</td>
<td><code class="small">{{ $cat->slug }}</code></td>
<td><span class="badge bg-secondary">{{ $cat->products_count }}</span></td>
<td><span class="badge {{ $cat->is_active?'bg-success':'bg-danger' }}">{{ $cat->is_active?'Active':'Inactive' }}</span></td>
<td>
<a href="{{ route('admin.categories.edit',$cat) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
<form action="{{ route('admin.categories.destroy',$cat) }}" method="POST" class="d-inline">
@csrf @method('DELETE')
<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this category?')"><i class="bi bi-trash"></i></button>
</form>
</td>
</tr>
@empty
<tr><td colspan="6" class="text-center text-muted py-4">No categories found.</td></tr>
@endforelse
</tbody>
</table>
</div>
</div>
<div class="mt-3">{{ $categories->links() }}</div>
@endsection
