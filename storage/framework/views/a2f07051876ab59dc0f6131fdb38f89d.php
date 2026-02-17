<?php $__env->startSection('title', $product->name); ?>
<?php $__env->startSection('content'); ?>
<nav aria-label="breadcrumb" class="mb-3">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
<li class="breadcrumb-item"><?php echo e($product->category->name); ?></li>
<li class="breadcrumb-item active"><?php echo e($product->name); ?></li>
</ol>
</nav>
<div class="row g-4">
<div class="col-md-5">
<img src="<?php echo e($product->image ? Storage::url($product->image) : 'https://via.placeholder.com/500x400?text='.urlencode($product->name)); ?>"
     class="img-fluid rounded-3 shadow-sm w-100" style="max-height:420px;object-fit:cover" alt="<?php echo e($product->name); ?>">
</div>
<div class="col-md-7">
<span class="badge bg-secondary mb-2"><?php echo e($product->category->name); ?></span>
<h2 class="fw-bold mb-2"><?php echo e($product->name); ?></h2>
<div class="mb-3">
<?php if($product->isOnSale()): ?>
<span class="fs-3 fw-bold text-danger">$<?php echo e(number_format($product->sale_price,2)); ?></span>
<span class="fs-5 text-muted text-decoration-line-through ms-2">$<?php echo e(number_format($product->price,2)); ?></span>
<span class="badge bg-danger ms-2"><?php echo e(round((($product->price-$product->sale_price)/$product->price)*100)); ?>% OFF</span>
<?php else: ?>
<span class="fs-3 fw-bold text-primary">$<?php echo e(number_format($product->price,2)); ?></span>
<?php endif; ?>
</div>
<p class="text-muted"><?php echo e($product->description); ?></p>
<div class="mb-3">
<span class="me-3"><strong>SKU:</strong> <code><?php echo e($product->sku); ?></code></span>
<span>
<strong>Availability:</strong>
<?php if($product->stock > 0): ?>
<span class="text-success fw-semibold"><i class="bi bi-check-circle me-1"></i>In Stock (<?php echo e($product->stock); ?> left)</span>
<?php else: ?>
<span class="text-danger fw-semibold"><i class="bi bi-x-circle me-1"></i>Out of Stock</span>
<?php endif; ?>
</span>
</div>
<?php if(auth()->guard()->check()): ?>
<?php if($product->stock > 0): ?>
<form action="<?php echo e(route('cart.add')); ?>" method="POST" class="d-flex gap-2 align-items-center">
<?php echo csrf_field(); ?>
<input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
<div style="width:100px">
<input type="number" name="quantity" class="form-control" value="1" min="1" max="<?php echo e($product->stock); ?>">
</div>
<button class="btn btn-primary px-4"><i class="bi bi-cart-plus me-2"></i>Add to Cart</button>
</form>
<?php else: ?>
<button class="btn btn-secondary" disabled>Out of Stock</button>
<?php endif; ?>
<?php else: ?>
<a href="<?php echo e(route('login')); ?>" class="btn btn-primary px-4"><i class="bi bi-box-arrow-in-right me-2"></i>Login to Add to Cart</a>
<?php endif; ?>
</div>
</div>

<?php if($related->count()): ?>
<div class="mt-5">
<h5 class="fw-bold mb-3">Related Products</h5>
<div class="row g-3">
<?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-6 col-md-3">
<div class="card border-0 shadow-sm product-card h-100">
<a href="<?php echo e(route('product.show',$p->slug)); ?>">
<img src="<?php echo e($p->image ? Storage::url($p->image) : 'https://via.placeholder.com/300x200?text='.urlencode($p->name)); ?>"
     class="card-img-top" style="height:140px;object-fit:cover">
</a>
<div class="card-body p-2">
<a href="<?php echo e(route('product.show',$p->slug)); ?>" class="text-dark text-decoration-none fw-semibold small"><?php echo e($p->name); ?></a>
<div class="text-primary fw-bold">$<?php echo e(number_format($p->getDisplayPrice(),2)); ?></div>
</div>
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\laravel\whitelabel-ecommerce\resources\views/user/products/show.blade.php ENDPATH**/ ?>