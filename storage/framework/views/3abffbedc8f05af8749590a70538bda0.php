<?php $__env->startSection('title','Shop'); ?>
<?php $__env->startSection('content'); ?>


<?php if($featured->count() && !request()->hasAny(['search','category','min_price'])): ?>
<div class="bg-light rounded-3 p-4 mb-4">
<h5 class="fw-bold mb-3"><i class="bi bi-star-fill text-warning me-2"></i>Featured Products</h5>
<div class="row g-3">
<?php $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-6 col-md-3">
<a href="<?php echo e(route('product.show',$p->slug)); ?>" class="text-decoration-none">
<div class="card border-0 shadow-sm product-card h-100">
<div class="position-relative">
<img src="<?php echo e($p->image ? Storage::url($p->image) : 'https://via.placeholder.com/300x200?text=No+Image'); ?>"
     class="card-img-top" style="height:140px;object-fit:cover" alt="<?php echo e($p->name); ?>">
<?php if($p->isOnSale()): ?><span class="badge bg-danger badge-sale">SALE</span><?php endif; ?>
</div>
<div class="card-body p-2">
<div class="fw-semibold small text-truncate"><?php echo e($p->name); ?></div>
<div class="text-primary fw-bold">$<?php echo e(number_format($p->getDisplayPrice(),2)); ?></div>
</div>
</div>
</a>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>
<?php endif; ?>

<div class="row g-4">

<div class="col-md-3">
<div class="card border-0 shadow-sm">
<div class="card-body">
<h6 class="fw-bold mb-3"><i class="bi bi-funnel me-2"></i>Filters</h6>
<form method="GET" action="<?php echo e(route('home')); ?>">
<?php if(request('search')): ?><input type="hidden" name="search" value="<?php echo e(request('search')); ?>"><?php endif; ?>
<div class="mb-3">
<label class="form-label small fw-semibold">Category</label>
<select name="category" class="form-select form-select-sm" onchange="this.form.submit()">
<option value="">All Categories</option>
<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($cat->id); ?>" <?php echo e(request('category')==$cat->id?'selected':''); ?>><?php echo e($cat->name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
</div>
<div class="mb-2">
<label class="form-label small fw-semibold">Price Range</label>
<div class="row g-1">
<div class="col-6"><input type="number" name="min_price" class="form-control form-control-sm" placeholder="Min" value="<?php echo e(request('min_price')); ?>"></div>
<div class="col-6"><input type="number" name="max_price" class="form-control form-control-sm" placeholder="Max" value="<?php echo e(request('max_price')); ?>"></div>
</div>
</div>
<div class="mb-3">
<label class="form-label small fw-semibold">Sort By</label>
<select name="sort" class="form-select form-select-sm">
<option value="latest" <?php echo e(request('sort','latest')=='latest'?'selected':''); ?>>Latest</option>
<option value="price_asc" <?php echo e(request('sort')=='price_asc'?'selected':''); ?>>Price: Low to High</option>
<option value="price_desc" <?php echo e(request('sort')=='price_desc'?'selected':''); ?>>Price: High to Low</option>
<option value="name" <?php echo e(request('sort')=='name'?'selected':''); ?>>Name A-Z</option>
</select>
</div>
<button type="submit" class="btn btn-primary btn-sm w-100">Apply Filters</button>
<a href="<?php echo e(route('home')); ?>" class="btn btn-outline-secondary btn-sm w-100 mt-2">Clear</a>
</form>
</div>
</div>
</div>


<div class="col-md-9">
<div class="d-flex justify-content-between align-items-center mb-3">
<span class="text-muted small">Showing <?php echo e($products->firstItem()); ?>–<?php echo e($products->lastItem()); ?> of <?php echo e($products->total()); ?> products</span>
</div>

<?php if($products->isEmpty()): ?>
<div class="text-center py-5">
<i class="bi bi-search display-1 text-muted"></i>
<h5 class="mt-3 text-muted">No products found</h5>
<a href="<?php echo e(route('home')); ?>" class="btn btn-primary mt-2">Browse All</a>
</div>
<?php else: ?>
<div class="row g-3">
<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-6 col-lg-4">
<div class="card border-0 shadow-sm product-card h-100">
<div class="position-relative">
<a href="<?php echo e(route('product.show',$product->slug)); ?>">
<img src="<?php echo e($product->image ? Storage::url($product->image) : 'https://via.placeholder.com/300x200?text='.urlencode($product->name)); ?>"
     class="card-img-top" style="height:180px;object-fit:cover" alt="<?php echo e($product->name); ?>">
</a>
<?php if($product->isOnSale()): ?><span class="badge bg-danger badge-sale">SALE</span><?php endif; ?>
<?php if($product->stock == 0): ?><span class="badge bg-secondary badge-sale" style="top:10px;left:10px;right:auto">OUT</span><?php endif; ?>
</div>
<div class="card-body d-flex flex-column">
<div class="small text-muted mb-1"><?php echo e($product->category->name); ?></div>
<h6 class="fw-bold mb-1 flex-grow-1">
<a href="<?php echo e(route('product.show',$product->slug)); ?>" class="text-dark text-decoration-none"><?php echo e($product->name); ?></a>
</h6>
<div class="mb-2">
<?php if($product->isOnSale()): ?>
<span class="fw-bold text-danger">$<?php echo e(number_format($product->sale_price,2)); ?></span>
<small class="text-muted text-decoration-line-through ms-1">$<?php echo e(number_format($product->price,2)); ?></small>
<?php else: ?>
<span class="fw-bold text-primary">$<?php echo e(number_format($product->price,2)); ?></span>
<?php endif; ?>
</div>
<?php if(auth()->guard()->check()): ?>
<?php if($product->stock > 0): ?>
<form action="<?php echo e(route('cart.add')); ?>" method="POST">
<?php echo csrf_field(); ?>
<input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
<input type="hidden" name="quantity" value="1">
<button class="btn btn-primary btn-sm w-100"><i class="bi bi-cart-plus me-1"></i>Add to Cart</button>
</form>
<?php else: ?>
<button class="btn btn-secondary btn-sm w-100" disabled>Out of Stock</button>
<?php endif; ?>
<?php else: ?>
<a href="<?php echo e(route('login')); ?>" class="btn btn-outline-primary btn-sm w-100">Login to Buy</a>
<?php endif; ?>
</div>
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="mt-4"><?php echo e($products->links()); ?></div>
<?php endif; ?>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\laravel\whitelabel-ecommerce\resources\views/user/products/index.blade.php ENDPATH**/ ?>