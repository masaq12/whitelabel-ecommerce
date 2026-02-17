@extends('layouts.admin')
@section('title', isset($product) ? 'Edit Product' : 'Add Product')
@section('content')
<div class="card border-0 shadow-sm">
<div class="card-body">
<form method="POST"
      action="{{ isset($product) ? route('admin.products.update',$product) : route('admin.products.store') }}"
      enctype="multipart/form-data">
@csrf
@if(isset($product)) @method('PUT') @endif
<div class="row g-3">
<div class="col-md-8">
<div class="row g-3">
<div class="col-12">
<label class="form-label fw-semibold">Product Name *</label>
<input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
       value="{{ old('name', $product->name ?? '') }}" required>
@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-md-6">
<label class="form-label fw-semibold">Category *</label>
<select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
<option value="">Select Category</option>
@foreach($categories as $cat)
<option value="{{ $cat->id }}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
@endforeach
</select>
@error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-md-6">
<label class="form-label fw-semibold">SKU *</label>
<input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror"
       value="{{ old('sku', $product->sku ?? '') }}" required>
@error('sku')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-md-4">
<label class="form-label fw-semibold">Price ($) *</label>
<input type="number" name="price" step="0.01" class="form-control @error('price') is-invalid @enderror"
       value="{{ old('price', $product->price ?? '') }}" required>
@error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-md-4">
<label class="form-label fw-semibold">Sale Price ($)</label>
<input type="number" name="sale_price" step="0.01" class="form-control @error('sale_price') is-invalid @enderror"
       value="{{ old('sale_price', $product->sale_price ?? '') }}" placeholder="Optional">
@error('sale_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-md-4">
<label class="form-label fw-semibold">Stock *</label>
<input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
       value="{{ old('stock', $product->stock ?? 0) }}" required min="0">
@error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-12">
<label class="form-label fw-semibold">Description</label>
<textarea name="description" class="form-control" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
</div>
</div>
</div>
<div class="col-md-4">
<div class="mb-3">
<label class="form-label fw-semibold">Product Image</label>
@isset($product)
@if($product->image)
<div class="mb-2"><img src="{{ Storage::url($product->image) }}" class="img-thumbnail" style="max-height:150px"></div>
@endif
@endisset
<input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
@error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
<div class="form-text">Max 2MB. JPG, PNG, WebP.</div>
</div>
<div class="mb-3 form-check">
<input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1"
       {{ old('is_active', isset($product) ? $product->is_active : true) ? 'checked' : '' }}>
<label class="form-check-label" for="is_active">Active (visible in store)</label>
</div>
<div class="mb-3 form-check">
<input type="checkbox" name="is_featured" class="form-check-input" id="is_featured" value="1"
       {{ old('is_featured', isset($product) && $product->is_featured) ? 'checked' : '' }}>
<label class="form-check-label" for="is_featured">Featured Product</label>
</div>
</div>
<div class="col-12 mt-2">
<button type="submit" class="btn btn-primary px-4">
<i class="bi bi-save me-2"></i>{{ isset($product) ? 'Update Product' : 'Create Product' }}
</button>
<a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
</div>
</div>
</form>
</div>
</div>
@endsection
