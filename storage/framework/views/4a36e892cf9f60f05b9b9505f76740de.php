<?php $__env->startSection('title','Categories'); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
<span class="text-muted small"><?php echo e($categories->total()); ?> categories</span>
<a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus me-1"></i>Add Category</a>
</div>
<div class="card border-0 shadow-sm">
<div class="table-responsive">
<table class="table mb-0">
<thead><tr><th>#</th><th>Name</th><th>Slug</th><th>Products</th><th>Status</th><th>Actions</th></tr></thead>
<tbody>
<?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr>
<td class="text-muted"><?php echo e($cat->id); ?></td>
<td class="fw-semibold"><?php echo e($cat->name); ?></td>
<td><code class="small"><?php echo e($cat->slug); ?></code></td>
<td><span class="badge bg-secondary"><?php echo e($cat->products_count); ?></span></td>
<td><span class="badge <?php echo e($cat->is_active?'bg-success':'bg-danger'); ?>"><?php echo e($cat->is_active?'Active':'Inactive'); ?></span></td>
<td>
<a href="<?php echo e(route('admin.categories.edit',$cat)); ?>" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
<form action="<?php echo e(route('admin.categories.destroy',$cat)); ?>" method="POST" class="d-inline">
<?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this category?')"><i class="bi bi-trash"></i></button>
</form>
</td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<tr><td colspan="6" class="text-center text-muted py-4">No categories found.</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
<div class="mt-3"><?php echo e($categories->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\laravel\whitelabel-ecommerce\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>