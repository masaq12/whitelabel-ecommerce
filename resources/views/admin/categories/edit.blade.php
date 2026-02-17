@extends('layouts.admin')
@section('title', isset($category) ? 'Edit Category' : 'Add Category')
@section('content')
<div class="col-md-6">
<div class="card border-0 shadow-sm">
<div class="card-body">
<form method="POST" action="{{ isset($category) ? route('admin.categories.update',$category) : route('admin.categories.store') }}">
@csrf
@if(isset($category)) @method('PUT') @endif
<div class="mb-3">
<label class="form-label fw-semibold">Name *</label>
<input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
       value="{{ old('name', $category->name ?? '') }}" required placeholder="Category name">
@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
<label class="form-label fw-semibold">Description</label>
<textarea name="description" class="form-control" rows="3" placeholder="Optional description">{{ old('description', $category->description ?? '') }}</textarea>
</div>
<div class="mb-4 form-check">
<input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1"
       {{ old('is_active', isset($category) ? $category->is_active : true) ? 'checked' : '' }}>
<label class="form-check-label" for="is_active">Active (visible on store)</label>
</div>
<button type="submit" class="btn btn-primary">
<i class="bi bi-save me-2"></i>{{ isset($category) ? 'Update Category' : 'Create Category' }}
</button>
<a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
</form>
</div>
</div>
</div>
@endsection
