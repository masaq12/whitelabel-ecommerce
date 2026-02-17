<?php $__env->startSection('title','Products'); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
<form method="GET" class="d-flex gap-2">
<input type="text" name="search" class="form-control form-control-sm" placeholder="Search..." value="<?php echo e(request('search')); ?>" style="width:200px">
<select name="category" class="form-select form-select-sm" style="width:160px">
<option value="">All Categories</option>
<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($cat->id); ?>" <?php echo e(request('category')==$cat->id?'selected':''); ?>><?php echo e($cat->name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<button class="btn btn-outline-secondary btn-sm"><i class="bi bi-search"></i></button>
</form>
<a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus me-1"></i>Add Product</a>
</div>
<div class="card border-0 shadow-sm">
<div class="table-responsive">
<table class="table mb-0 align-middle">
<thead><tr><th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Status</th><th>Actions</th></tr></thead>
<tbody>
<?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr>
<td><img src="<?php echo e($p->image ? Storage::url($p->image) : 'https://via.placeholder.com/50?text=P'); ?>" width="50" height="50" style="object-fit:cover;border-radius:6px"></td>
<td><div class="fw-semibold"><?php echo e($p->name); ?></div><small class="text-muted"><?php echo e($p->sku); ?></small></td>
<td><?php echo e($p->category->name); ?></td>
<td>
<?php if($p->sale_price): ?>
<div class="text-danger fw-bold">$<?php echo e(number_format($p->sale_price,2)); ?></div>
<small class="text-muted text-decoration-line-through">$<?php echo e(number_format($p->price,2)); ?></small>
<?php else: ?>
<div class="fw-bold">$<?php echo e(number_format($p->price,2)); ?></div>
<?php endif; ?>
</td>
<td><span class="badge <?php echo e($p->stock>10?'bg-success':($p->stock>0?'bg-warning text-dark':'bg-danger')); ?>"><?php echo e($p->stock); ?></span></td>
<td><span class="badge <?php echo e($p->is_active?'bg-success':'bg-secondary'); ?>"><?php echo e($p->is_active?'Active':'Inactive'); ?></span></td>
<td>
<a href="<?php echo e(route('admin.products.edit',$p)); ?>" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
<form action="<?php echo e(route('admin.products.destroy',$p)); ?>" method="POST" class="d-inline">
<?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this product?')"><i class="bi bi-trash"></i></button>
</form>
</td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<tr><td colspan="7" class="text-center text-muted py-4">No products found.</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
<div class="mt-3"><?php echo e($products->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\laravel\whitelabel-ecommerce\resources\views/admin/products/index.blade.php ENDPATH**/ ?>