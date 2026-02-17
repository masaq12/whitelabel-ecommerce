@extends('layouts.app')
@section('title', $product->name)
@section('content')
<nav aria-label="breadcrumb" class="mb-3">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item">{{ $product->category->name }}</li>
<li class="breadcrumb-item active">{{ $product->name }}</li>
</ol>
</nav>
<div class="row g-4">
<div class="col-md-5">
<img src="{{ $product->image ? Storage::url($product->image) : 'https://via.placeholder.com/500x400?text='.urlencode($product->name) }}"
     class="img-fluid rounded-3 shadow-sm w-100" style="max-height:420px;object-fit:cover" alt="{{ $product->name }}">
</div>
<div class="col-md-7">
<span class="badge bg-secondary mb-2">{{ $product->category->name }}</span>
<h2 class="fw-bold mb-2">{{ $product->name }}</h2>
<div class="mb-3">
@if($product->isOnSale())
<span class="fs-3 fw-bold text-danger">${{ number_format($product->sale_price,2) }}</span>
<span class="fs-5 text-muted text-decoration-line-through ms-2">${{ number_format($product->price,2) }}</span>
<span class="badge bg-danger ms-2">{{ round((($product->price-$product->sale_price)/$product->price)*100) }}% OFF</span>
@else
<span class="fs-3 fw-bold text-primary">${{ number_format($product->price,2) }}</span>
@endif
</div>
<p class="text-muted">{{ $product->description }}</p>
<div class="mb-3">
<span class="me-3"><strong>SKU:</strong> <code>{{ $product->sku }}</code></span>
<span>
<strong>Availability:</strong>
@if($product->stock > 0)
<span class="text-success fw-semibold"><i class="bi bi-check-circle me-1"></i>In Stock ({{ $product->stock }} left)</span>
@else
<span class="text-danger fw-semibold"><i class="bi bi-x-circle me-1"></i>Out of Stock</span>
@endif
</span>
</div>
@auth
@if($product->stock > 0)
<form action="{{ route('cart.add') }}" method="POST" class="d-flex gap-2 align-items-center">
@csrf
<input type="hidden" name="product_id" value="{{ $product->id }}">
<div style="width:100px">
<input type="number" name="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}">
</div>
<button class="btn btn-primary px-4"><i class="bi bi-cart-plus me-2"></i>Add to Cart</button>
</form>
@else
<button class="btn btn-secondary" disabled>Out of Stock</button>
@endif
@else
<a href="{{ route('login') }}" class="btn btn-primary px-4"><i class="bi bi-box-arrow-in-right me-2"></i>Login to Add to Cart</a>
@endauth
</div>
</div>

@if($related->count())
<div class="mt-5">
<h5 class="fw-bold mb-3">Related Products</h5>
<div class="row g-3">
@foreach($related as $p)
<div class="col-6 col-md-3">
<div class="card border-0 shadow-sm product-card h-100">
<a href="{{ route('product.show',$p->slug) }}">
<img src="{{ $p->image ? Storage::url($p->image) : 'https://via.placeholder.com/300x200?text='.urlencode($p->name) }}"
     class="card-img-top" style="height:140px;object-fit:cover">
</a>
<div class="card-body p-2">
<a href="{{ route('product.show',$p->slug) }}" class="text-dark text-decoration-none fw-semibold small">{{ $p->name }}</a>
<div class="text-primary fw-bold">${{ number_format($p->getDisplayPrice(),2) }}</div>
</div>
</div>
</div>
@endforeach
</div>
</div>
@endif
@endsection
