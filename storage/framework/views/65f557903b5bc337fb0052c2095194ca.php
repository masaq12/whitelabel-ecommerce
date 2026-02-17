<?php $__env->startSection('title','Orders'); ?>
<?php $__env->startSection('content'); ?>
<form method="GET" class="d-flex gap-2 mb-3">
<input type="text" name="search" class="form-control form-control-sm" placeholder="Order number..." value="<?php echo e(request('search')); ?>" style="width:200px">
<select name="status" class="form-select form-select-sm" style="width:160px" onchange="this.form.submit()">
<option value="">All Statuses</option>
<?php $__currentLoopData = ['pending','processing','shipped','delivered','cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($s); ?>" <?php echo e(request('status')==$s?'selected':''); ?>><?php echo e(ucfirst($s)); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<button class="btn btn-outline-secondary btn-sm"><i class="bi bi-search"></i></button>
</form>
<div class="card border-0 shadow-sm">
<div class="table-responsive">
<table class="table mb-0">
<thead><tr><th>Order #</th><th>Customer</th><th>Total</th><th>Payment</th><th>Status</th><th>Date</th><th></th></tr></thead>
<tbody>
<?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr>
<td><code><?php echo e($order->order_number); ?></code></td>
<td><?php echo e($order->user->name); ?></td>
<td>$<?php echo e(number_format($order->total_amount,2)); ?></td>
<td><span class="badge <?php echo e($order->payment_status=='success'?'bg-success':($order->payment_status=='failed'?'bg-danger':'bg-warning text-dark')); ?>"><?php echo e(ucfirst($order->payment_status)); ?></span></td>
<td><span class="badge badge-<?php echo e($order->status); ?>"><?php echo e(ucfirst($order->status)); ?></span></td>
<td><?php echo e($order->created_at->format('M d, Y')); ?></td>
<td><a href="<?php echo e(route('admin.orders.show',$order)); ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<tr><td colspan="7" class="text-center text-muted py-4">No orders found.</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
<div class="mt-3"><?php echo e($orders->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\laravel\whitelabel-ecommerce\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>