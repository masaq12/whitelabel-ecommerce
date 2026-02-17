<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', $settings->site_name); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary: <?php echo e($settings->primary_color ?? '#007bff'); ?>;
            --secondary: <?php echo e($settings->secondary_color ?? '#6c757d'); ?>;
        }
        .bg-primary-custom { background-color: var(--primary) !important; }
        .btn-primary { background-color: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { filter: brightness(0.9); }
        .text-primary { color: var(--primary) !important; }
        .navbar { background-color: var(--primary) !important; }
        .product-card { transition: transform .2s, box-shadow .2s; }
        .product-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,.12); }
        .badge-sale { position: absolute; top: 10px; right: 10px; }
        footer { background: #222; color: #aaa; }
        .cart-badge { position: absolute; top: -6px; right: -6px; font-size: 10px; }
    </style>
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="<?php echo e(route('home')); ?>">
            <?php if($settings->logo): ?>
                <img src="<?php echo e(Storage::url($settings->logo)); ?>" alt="<?php echo e($settings->site_name); ?>" height="40">
            <?php else: ?>
                <i class="bi bi-shop me-2"></i><?php echo e($settings->site_name); ?>

            <?php endif; ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <form class="d-flex mx-auto w-50" action="<?php echo e(route('home')); ?>" method="GET">
                <input class="form-control me-2" type="search" name="search" placeholder="Search products..."
                       value="<?php echo e(request('search')); ?>">
                <button class="btn btn-light" type="submit"><i class="bi bi-search"></i></button>
            </form>
            <ul class="navbar-nav ms-auto align-items-center">
                <?php if(auth()->guard()->check()): ?>
                    <li class="nav-item me-2 position-relative">
                        <a class="nav-link" href="<?php echo e(route('cart.index')); ?>">
                            <i class="bi bi-cart3 fs-5"></i>
                            <?php $cnt = \App\Models\Cart::where('user_id',auth()->id())->sum('quantity'); ?>
                            <?php if($cnt > 0): ?>
                                <span class="badge bg-danger rounded-pill cart-badge"><?php echo e($cnt); ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i><?php echo e(auth()->user()->name); ?>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?php echo e(route('user.dashboard')); ?>"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('order.history')); ?>"><i class="bi bi-bag me-2"></i>Orders</a></li>
                            <li><a class="dropdown-item" href="<?php echo e(route('user.profile')); ?>"><i class="bi bi-person me-2"></i>Profile</a></li>
                            <?php if(auth()->user()->isAdmin()): ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="<?php echo e(route('admin.dashboard')); ?>"><i class="bi bi-shield me-2"></i>Admin Panel</a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="<?php echo e(route('logout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login')); ?>"><i class="bi bi-box-arrow-in-right me-1"></i>Login</a></li>
                    <li class="nav-item"><a class="btn btn-light btn-sm ms-2" href="<?php echo e(route('register')); ?>">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Flash Messages -->
<div class="container mt-3">
    <?php $__currentLoopData = ['success','error','warning','info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(session($type)): ?>
            <div class="alert alert-<?php echo e($type === 'error' ? 'danger' : $type); ?> alert-dismissible fade show">
                <?php echo e(session($type)); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<!-- Main Content -->
<main class="container my-4">
    <?php echo $__env->yieldContent('content'); ?>
</main>

<!-- Footer -->
<footer class="py-4 mt-5">
    <div class="container text-center">
        <p class="mb-0"><?php echo e($settings->footer_text ?? '© '.date('Y').' '.$settings->site_name.'. All rights reserved.'); ?></p>
        <?php if($settings->contact_email): ?>
            <small>
                <i class="bi bi-envelope me-1"></i><?php echo e($settings->contact_email); ?>

                <?php if($settings->contact_phone): ?>
                    &nbsp;|&nbsp;<i class="bi bi-telephone me-1"></i><?php echo e($settings->contact_phone); ?>

                <?php endif; ?>
            </small>
        <?php endif; ?>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH E:\laravel\whitelabel-ecommerce\resources\views/layouts/app.blade.php ENDPATH**/ ?>