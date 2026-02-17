@extends('layouts.app')
@section('title','Shop')
@section('content')

{{-- Featured Banner --}}
@if($featured->count() && !request()->hasAny(['search','category','min_price']))
<div class="bg-light rounded-3 p-4 mb-4">
<h5 class="fw-bold mb-3"><i class="bi bi-star-fill text-warning me-2"></i>Featured Products</h5>
<div class="row g-3">
@foreach($featured as $p)
<div class="col-6 col-md-3">
<a href="{{ route('product.show',$p->slug) }}" class="text-decoration-none">
<div class="card border-0 shadow-sm product-card h-100">
<div class="position-relative">
<img src="{{ $p->image ? Storage::url($p->image) : 'https://via.placeholder.com/300x200?text=No+Image' }}"
     class="card-img-top" style="height:140px;object-fit:cover" alt="{{ $p->name }}">
@if($p->isOnSale())<span class="badge bg-danger badge-sale">SALE</span>@endif
</div>
<div class="card-body p-2">
<div class="fw-semibold small text-truncate">{{ $p->name }}</div>
<div class="text-primary fw-bold">${{ number_format($p->getDisplayPrice(),2) }}</div>
</div>
</div>
</a>
</div>
@endforeach
</div>
</div>
@endif

<div class="row g-4">
{{-- Filters Sidebar --}}
<div class="col-md-3">
<div class="card border-0 shadow-sm">
<div class="card-body">
<h6 class="fw-bold mb-3"><i class="bi bi-funnel me-2"></i>Filters</h6>
<form method="GET" action="{{ route('home') }}">
@if(request('search'))<input type="hidden" name="search" value="{{ request('search') }}">@endif
<div class="mb-3">
<label class="form-label small fw-semibold">Category</label>
<select name="category" class="form-select form-select-sm" onchange="this.form.submit()">
<option value="">All Categories</option>
@foreach($categories as $cat)
<option value="{{ $cat->id }}" {{ request('category')==$cat->id?'selected':'' }}>{{ $cat->name }}</option>
@endforeach
</select>
</div>
<div class="mb-2">
<label class="form-label small fw-semibold">Price Range</label>
<div class="row g-1">
<div class="col-6"><input type="number" name="min_price" class="form-control form-control-sm" placeholder="Min" value="{{ request('min_price') }}"></div>
<div class="col-6"><input type="number" name="max_price" class="form-control form-control-sm" placeholder="Max" value="{{ request('max_price') }}"></div>
</div>
</div>
<div class="mb-3">
<label class="form-label small fw-semibold">Sort By</label>
<select name="sort" class="form-select form-select-sm">
<option value="latest" {{ request('sort','latest')=='latest'?'selected':'' }}>Latest</option>
<option value="price_asc" {{ request('sort')=='price_asc'?'selected':'' }}>Price: Low to High</option>
<option value="price_desc" {{ request('sort')=='price_desc'?'selected':'' }}>Price: High to Low</option>
<option value="name" {{ request('sort')=='name'?'selected':'' }}>Name A-Z</option>
</select>
</div>
<button type="submit" class="btn btn-primary btn-sm w-100">Apply Filters</button>
<a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm w-100 mt-2">Clear</a>
</form>
</div>
</div>
</div>

{{-- Product Grid --}}
<div class="col-md-9">
<div class="d-flex justify-content-between align-items-center mb-3">
<span class="text-muted small">Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} products</span>
</div>

@if($products->isEmpty())
<div class="text-center py-5">
<i class="bi bi-search display-1 text-muted"></i>
<h5 class="mt-3 text-muted">No products found</h5>
<a href="{{ route('home') }}" class="btn btn-primary mt-2">Browse All</a>
</div>
@else
<div class="row g-3">
@foreach($products as $product)
<div class="col-6 col-lg-4">
<div class="card border-0 shadow-sm product-card h-100">
<div class="position-relative">
<a href="{{ route('product.show',$product->slug) }}">
<img src="{{ $product->image ? Storage::url($product->image) : 'https://via.placeholder.com/300x200?text='.urlencode($product->name) }}"
     class="card-img-top" style="height:180px;object-fit:cover" alt="{{ $product->name }}">
</a>
@if($product->isOnSale())<span class="badge bg-danger badge-sale">SALE</span>@endif
@if($product->stock == 0)<span class="badge bg-secondary badge-sale" style="top:10px;left:10px;right:auto">OUT</span>@endif
</div>
<div class="card-body d-flex flex-column">
<div class="small text-muted mb-1">{{ $product->category->name }}</div>
<h6 class="fw-bold mb-1 flex-grow-1">
<a href="{{ route('product.show',$product->slug) }}" class="text-dark text-decoration-none">{{ $product->name }}</a>
</h6>
<div class="mb-2">
@if($product->isOnSale())
<span class="fw-bold text-danger">${{ number_format($product->sale_price,2) }}</span>
<small class="text-muted text-decoration-line-through ms-1">${{ number_format($product->price,2) }}</small>
@else
<span class="fw-bold text-primary">${{ number_format($product->price,2) }}</span>
@endif
</div>
@auth
@if($product->stock > 0)
<form action="{{ route('cart.add') }}" method="POST">
@csrf
<input type="hidden" name="product_id" value="{{ $product->id }}">
<input type="hidden" name="quantity" value="1">
<button class="btn btn-primary btn-sm w-100"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
</form>
@else
<button class="btn btn-secondary btn-sm w-100" disabled>Out of Stock</button>
@endif
@else
<a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm w-100">Login to Buy</a>
@endauth
</div>
</div>
</div>
@endforeach
</div>
<div class="mt-4">{{ $products->links() }}</div>
@endif
</div>
</div>
@endsection
