<?php $__env->startSection('title','Login'); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
<div class="col-md-5">
<div class="card shadow-sm border-0 rounded-3">
<div class="card-body p-4">
<h4 class="fw-bold mb-4 text-center"><i class="bi bi-box-arrow-in-right me-2"></i>Sign In</h4>
<form method="POST" action="<?php echo e(route('login')); ?>">
<?php echo csrf_field(); ?>
<div class="mb-3">
<label class="form-label fw-semibold">Email Address</label>
<input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
       value="<?php echo e(old('email')); ?>" required autofocus placeholder="you@example.com">
<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<div class="mb-3">
<label class="form-label fw-semibold">Password</label>
<input type="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
       required placeholder="••••••••">
<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<div class="mb-4 form-check">
<input type="checkbox" name="remember" class="form-check-input" id="remember">
<label class="form-check-label" for="remember">Remember me</label>
</div>
<button type="submit" class="btn btn-primary w-100 py-2">
    <i class="bi bi-box-arrow-in-right me-2"></i>Login
</button>
</form>
<hr class="my-3">
<p class="text-center mb-0 text-muted">
    Don't have an account? <a href="<?php echo e(route('register')); ?>" class="fw-semibold">Register here</a>
</p>
</div>
</div>
<p class="text-center text-muted small mt-3">
    <strong>Demo:</strong> user@example.com / password123
</p>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\laravel\whitelabel-ecommerce\resources\views/auth/login.blade.php ENDPATH**/ ?>