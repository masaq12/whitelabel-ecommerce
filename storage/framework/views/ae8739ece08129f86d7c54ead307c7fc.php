<?php $__env->startSection('title', isset($category) ? 'Edit Category' : 'Add Category'); ?>
<?php $__env->startSection('content'); ?>
<div class="col-md-6">
<div class="card border-0 shadow-sm">
<div class="card-body">
<form method="POST" action="<?php echo e(isset($category) ? route('admin.categories.update',$category) : route('admin.categories.store')); ?>">
<?php echo csrf_field(); ?>
<?php if(isset($category)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
<div class="mb-3">
<label class="form-label fw-semibold">Name *</label>
<input type="text" name="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
       value="<?php echo e(old('name', $category->name ?? '')); ?>" required placeholder="Category name">
<?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<div class="mb-3">
<label class="form-label fw-semibold">Description</label>
<textarea name="description" class="form-control" rows="3" placeholder="Optional description"><?php echo e(old('description', $category->description ?? '')); ?></textarea>
</div>
<div class="mb-4 form-check">
<input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1"
       <?php echo e(old('is_active', isset($category) ? $category->is_active : true) ? 'checked' : ''); ?>>
<label class="form-check-label" for="is_active">Active (visible on store)</label>
</div>
<button type="submit" class="btn btn-primary">
<i class="bi bi-save me-2"></i><?php echo e(isset($category) ? 'Update Category' : 'Create Category'); ?>

</button>
<a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-outline-secondary ms-2">Cancel</a>
</form>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\laravel\whitelabel-ecommerce\resources\views/admin/categories/edit.blade.php ENDPATH**/ ?>