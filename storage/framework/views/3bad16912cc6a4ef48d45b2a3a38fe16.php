<?php $__env->startSection('title','Order #'.$order->order_number); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
<a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<div class="row g-4">
<div class="col-md-8">
<div class="card border-0 shadow-sm mb-3">
<div class="card-body">
<h6 class="fw-bold mb-3">Update Order Status</h6>
<form method="POST" action="<?php echo e(route('admin.orders.status',$order)); ?>" class="d-flex gap-2">
<?php echo csrf_field(); ?>
<select name="status" class="form-select form-select-sm" style="width:200px">
<?php $__currentLoopData = ['pending','processing','shipped','delivered','cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($s); ?>" <?php echo e($order->status==$s?'selected':''); ?>><?php echo e(ucfirst($s)); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<button class="btn btn-primary btn-sm"><i class="bi bi-check me-1"></i>Update</button>
</form>
</div>
</div>
<div class="card border-0 shadow-sm">
<div class="card-body">
<h6 class="fw-bold mb-3">Order Items</h6>
<table class="table">
<thead><tr><th>Product</th><th class="text-center">Qty</th><th class="text-center">Price</th><th class="text-end">Subtotal</th></tr></thead>
<tbody>
<?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
<td>
<div class="d-flex align-items-center gap-2">
<img src="<?php echo e($item->product->image ? Storage::url($item->product->image) : 'https://via.placeholder.com/40?text=P'); ?>" width="40" height="40" style="object-fit:cover;border-radius:4px">
<span><?php echo e($item->product->name); ?></span>
</div>
</td>
<td class="text-center"><?php echo e($item->quantity); ?></td>
<td class="text-center">$<?php echo e(number_format($item->price,2)); ?></td>
<td class="text-end fw-semibold">$<?php echo e(number_format($item->subtotal,2)); ?></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
<tfoot>
<tr><td colspan="3" class="text-end fw-bold">Total</td><td class="text-end fw-bold fs-6">$<?php echo e(number_format($order->total_amount,2)); ?></td></tr>
</tfoot>
</table>
</div>
</div>
</div>
<div class="col-md-4">
<div class="card border-0 shadow-sm mb-3">
<div class="card-body">
<h6 class="fw-bold mb-3">Order Info</h6>
<dl class="row mb-0 small">
<dt class="col-5">Order #</dt><dd class="col-7"><code><?php echo e($order->order_number); ?></code></dd>
<dt class="col-5">Date</dt><dd class="col-7"><?php echo e($order->created_at->format('M d, Y H:i')); ?></dd>
<dt class="col-5">Status</dt><dd class="col-7"><span class="badge badge-<?php echo e($order->status); ?>"><?php echo e(ucfirst($order->status)); ?></span></dd>
<dt class="col-5">Payment</dt><dd class="col-7"><span class="badge <?php echo e($order->payment_status=='success'?'bg-success':'bg-danger'); ?>"><?php echo e(ucfirst($order->payment_status)); ?></span></dd>
<dt class="col-5">Method</dt><dd class="col-7"><?php echo e(str_replace('_',' ',ucfirst($order->payment_method))); ?></dd>
</dl>
</div>
</div>
<div class="card border-0 shadow-sm mb-3">
<div class="card-body">
<h6 class="fw-bold mb-3">Customer</h6>
<p class="mb-1 fw-semibold"><?php echo e($order->user->name); ?></p>
<p class="mb-1 small text-muted"><?php echo e($order->user->email); ?></p>
<p class="mb-0 small text-muted"><?php echo e($order->user->phone); ?></p>
</div>
</div>
<div class="card border-0 shadow-sm">
<div class="card-body">
<h6 class="fw-bold mb-3">Shipping Address</h6>
<p class="mb-0 small text-muted">
<?php echo e($order->shipping_address); ?><br>
<?php echo e($order->shipping_city); ?>, <?php echo e($order->shipping_state); ?> <?php echo e($order->shipping_zip); ?>

</p>
<?php if($order->notes): ?><p class="mt-2 mb-0 small"><strong>Notes:</strong> <?php echo e($order->notes); ?></p><?php endif; ?>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\laravel\whitelabel-ecommerce\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>