<?php $__env->startSection('title', $user->name); ?>
<?php $__env->startSection('content'); ?>
<a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-outline-secondary btn-sm mb-4"><i class="bi bi-arrow-left me-1"></i>Back</a>
<div class="row g-4">
<div class="col-md-4">
<div class="card border-0 shadow-sm">
<div class="card-body text-center">
<div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:80px;height:80px;font-size:2rem">
<i class="bi bi-person text-muted"></i></div>
<h5 class="fw-bold"><?php echo e($user->name); ?></h5>
<p class="text-muted mb-1"><?php echo e($user->email); ?></p>
<p class="text-muted small mb-3"><?php echo e($user->phone ?? 'No phone'); ?></p>
<p class="text-muted small">Joined <?php echo e($user->created_at->format('M d, Y')); ?></p>
</div>
</div>
</div>
<div class="col-md-8">
<div class="card border-0 shadow-sm">
<div class="card-body">
<h6 class="fw-bold mb-3">Order History</h6>
<?php if($user->orders->isEmpty()): ?>
<p class="text-muted">No orders yet.</p>
<?php else: ?>
<table class="table table-sm">
<thead><tr><th>Order #</th><th>Total</th><th>Status</th><th>Date</th></tr></thead>
<tbody>
<?php $__currentLoopData = $user->orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
<td><code><?php echo e($order->order_number); ?></code></td>
<td>$<?php echo e(number_format($order->total_amount,2)); ?></td>
<td><span class="badge badge-<?php echo e($order->status); ?>"><?php echo e(ucfirst($order->status)); ?></span></td>
<td><?php echo e($order->created_at->format('M d, Y')); ?></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
<?php endif; ?>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\laravel\whitelabel-ecommerce\resources\views/admin/users/show.blade.php ENDPATH**/ ?>