<?php $__env->startSection('title','Users'); ?>
<?php $__env->startSection('content'); ?>
<form method="GET" class="d-flex gap-2 mb-3">
<input type="text" name="search" class="form-control form-control-sm" placeholder="Search name or email..." value="<?php echo e(request('search')); ?>" style="width:250px">
<button class="btn btn-outline-secondary btn-sm"><i class="bi bi-search"></i></button>
</form>
<div class="card border-0 shadow-sm">
<div class="table-responsive">
<table class="table mb-0">
<thead><tr><th>#</th><th>Name</th><th>Email</th><th>Phone</th><th>Orders</th><th>Joined</th><th></th></tr></thead>
<tbody>
<?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr>
<td><?php echo e($user->id); ?></td>
<td class="fw-semibold"><?php echo e($user->name); ?></td>
<td><?php echo e($user->email); ?></td>
<td><?php echo e($user->phone ?? '—'); ?></td>
<td><span class="badge bg-secondary"><?php echo e($user->orders_count ?? 0); ?></span></td>
<td><?php echo e($user->created_at->format('M d, Y')); ?></td>
<td>
<a href="<?php echo e(route('admin.users.show',$user)); ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
</td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<tr><td colspan="7" class="text-center text-muted py-4">No users found.</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
<div class="mt-3"><?php echo e($users->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\laravel\whitelabel-ecommerce\resources\views/admin/users/index.blade.php ENDPATH**/ ?>