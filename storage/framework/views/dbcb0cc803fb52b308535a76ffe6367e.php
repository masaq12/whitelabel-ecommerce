<?php $__env->startSection('title','My Dashboard'); ?>
<?php $__env->startSection('content'); ?>
<h4 class="fw-bold mb-4"><i class="bi bi-speedometer2 me-2"></i>My Dashboard</h4>
<div class="row g-3 mb-4">
<div class="col-sm-4">
<div class="card border-0 shadow-sm text-center p-3">
<div class="fs-1 text-primary"><i class="bi bi-bag-check"></i></div>
<div class="fs-3 fw-bold"><?php echo e($totalOrders); ?></div>
<div class="text-muted small">Total Orders</div>
</div>
</div>
<div class="col-sm-4">
<div class="card border-0 shadow-sm text-center p-3">
<div class="fs-1 text-success"><i class="bi bi-person-check"></i></div>
<div class="fw-bold"><?php echo e($user->name); ?></div>
<div class="text-muted small"><?php echo e($user->email); ?></div>
</div>
</div>
<div class="col-sm-4">
<div class="card border-0 shadow-sm text-center p-3">
<a href="<?php echo e(route('user.profile')); ?>" class="text-decoration-none">
<div class="fs-1 text-warning"><i class="bi bi-gear"></i></div>
<div class="fw-bold text-dark">Edit Profile</div>
<div class="text-muted small">Update your info</div>
</a>
</div>
</div>
</div>
<h5 class="fw-bold mb-3">Recent Orders</h5>
<?php if($recentOrders->isEmpty()): ?>
<div class="alert alert-light border">No orders yet. <a href="<?php echo e(route('home')); ?>">Start shopping!</a></div>
<?php else: ?>
<div class="card border-0 shadow-sm">
<table class="table mb-0">
<thead><tr><th>Order #</th><th>Date</th><th>Total</th><th>Status</th><th></th></tr></thead>
<tbody>
<?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
<td><code><?php echo e($order->order_number); ?></code></td>
<td><?php echo e($order->created_at->format('M d, Y')); ?></td>
<td>$<?php echo e(number_format($order->total_amount,2)); ?></td>
<td><span class="badge badge-<?php echo e($order->status); ?>"><?php echo e(ucfirst($order->status)); ?></span></td>
<td><a href="<?php echo e(route('order.show',$order->id)); ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
</div>
<a href="<?php echo e(route('order.history')); ?>" class="btn btn-outline-primary mt-3 btn-sm">View All Orders</a>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\laravel\whitelabel-ecommerce\resources\views/user/dashboard/index.blade.php ENDPATH**/ ?>