<?php $__env->startSection('title','My Orders'); ?>
<?php $__env->startSection('content'); ?>
<h4 class="fw-bold mb-4"><i class="bi bi-bag me-2"></i>Order History</h4>
<?php if($orders->isEmpty()): ?>
<div class="text-center py-5">
<i class="bi bi-bag-x display-1 text-muted"></i>
<h5 class="mt-3 text-muted">No orders yet</h5>
<a href="<?php echo e(route('home')); ?>" class="btn btn-primary mt-2">Start Shopping</a>
</div>
<?php else: ?>
<div class="card border-0 shadow-sm">
<div class="table-responsive">
<table class="table mb-0">
<thead><tr><th>Order #</th><th>Date</th><th>Total</th><th>Payment</th><th>Status</th><th>Action</th></tr></thead>
<tbody>
<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
<td><code><?php echo e($order->order_number); ?></code></td>
<td><?php echo e($order->created_at->format('M d, Y')); ?></td>
<td>$<?php echo e(number_format($order->total_amount,2)); ?></td>
<td>
<span class="badge <?php echo e($order->payment_status=='success'?'bg-success':($order->payment_status=='failed'?'bg-danger':'bg-warning text-dark')); ?>">
<?php echo e(ucfirst($order->payment_status)); ?>

</span>
</td>
<td><span class="badge badge-<?php echo e($order->status); ?>"><?php echo e(ucfirst($order->status)); ?></span></td>
<td><a href="<?php echo e(route('order.show',$order->id)); ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
</div>
</div>
<div class="mt-3"><?php echo e($orders->links()); ?></div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\laravel\whitelabel-ecommerce\resources\views/user/orders/history.blade.php ENDPATH**/ ?>