<?php $__env->startSection('title','Dashboard'); ?>
<?php $__env->startSection('content'); ?>
<div class="row g-3 mb-4">
<div class="col-sm-6 col-xl-3">
<div class="card stat-card"><div class="card-body d-flex align-items-center gap-3">
<div class="icon-box bg-primary bg-opacity-10"><i class="bi bi-people-fill text-primary"></i></div>
<div><div class="fs-4 fw-bold"><?php echo e($stats['total_users']); ?></div><div class="text-muted small">Total Users</div></div>
</div></div>
</div>
<div class="col-sm-6 col-xl-3">
<div class="card stat-card"><div class="card-body d-flex align-items-center gap-3">
<div class="icon-box bg-success bg-opacity-10"><i class="bi bi-box-seam text-success"></i></div>
<div><div class="fs-4 fw-bold"><?php echo e($stats['total_products']); ?></div><div class="text-muted small">Total Products</div></div>
</div></div>
</div>
<div class="col-sm-6 col-xl-3">
<div class="card stat-card"><div class="card-body d-flex align-items-center gap-3">
<div class="icon-box bg-warning bg-opacity-10"><i class="bi bi-bag-check text-warning"></i></div>
<div><div class="fs-4 fw-bold"><?php echo e($stats['total_orders']); ?></div><div class="text-muted small">Total Orders</div></div>
</div></div>
</div>
<div class="col-sm-6 col-xl-3">
<div class="card stat-card"><div class="card-body d-flex align-items-center gap-3">
<div class="icon-box bg-info bg-opacity-10"><i class="bi bi-currency-dollar text-info"></i></div>
<div><div class="fs-4 fw-bold">$<?php echo e(number_format($stats['total_revenue'],2)); ?></div><div class="text-muted small">Revenue</div></div>
</div></div>
</div>
</div>

<div class="row g-3 mb-4">
<?php $__currentLoopData = ['pending'=>'warning','processing'=>'info','shipped'=>'primary','delivered'=>'success']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status=>$color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-6 col-md-3">
<div class="card border-0 shadow-sm text-center p-3">
<div class="fs-3 fw-bold text-<?php echo e($color); ?>"><?php echo e($stats[$status.'_orders']); ?></div>
<div class="text-muted small"><?php echo e(ucfirst($status)); ?></div>
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div class="card border-0 shadow-sm">
<div class="card-body">
<h6 class="fw-bold mb-3">Recent Orders</h6>
<div class="table-responsive">
<table class="table">
<thead><tr><th>Order #</th><th>Customer</th><th>Amount</th><th>Status</th><th>Date</th><th></th></tr></thead>
<tbody>
<?php $__currentLoopData = $recent_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
<td><code><?php echo e($order->order_number); ?></code></td>
<td><?php echo e($order->user->name); ?></td>
<td>$<?php echo e(number_format($order->total_amount,2)); ?></td>
<td><span class="badge badge-<?php echo e($order->status); ?>"><?php echo e(ucfirst($order->status)); ?></span></td>
<td><?php echo e($order->created_at->format('M d, Y')); ?></td>
<td><a href="<?php echo e(route('admin.orders.show',$order)); ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\laravel\whitelabel-ecommerce\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>