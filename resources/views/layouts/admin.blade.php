<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin – @yield('title', 'Dashboard') | {{ $settings->site_name }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root { --primary: {{ $settings->primary_color ?? '#007bff' }}; }
        body { background: #f4f6f9; }
        .sidebar { width: 250px; min-height: 100vh; background: #1e2a38; position: fixed; top: 0; left: 0; overflow-y: auto; z-index: 100; }
        .sidebar-brand { padding: 20px; font-size: 1.2rem; font-weight: 700; color: #fff; border-bottom: 1px solid #2d3d50; }
        .sidebar .nav-link { color: #a0aec0; padding: 10px 20px; display: flex; align-items: center; gap: 10px; transition: all .2s; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background: var(--primary); }
        .sidebar .nav-link i { width: 20px; }
        .main-content { margin-left: 250px; padding: 20px; min-height: 100vh; }
        .topbar { background: #fff; padding: 12px 20px; margin: -20px -20px 20px; box-shadow: 0 1px 4px rgba(0,0,0,.08); display: flex; justify-content: space-between; align-items: center; }
        .stat-card { border: none; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,.06); }
        .stat-card .icon-box { width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; }
        .table th { background: #f8f9fa; font-weight: 600; font-size: .85rem; text-transform: uppercase; letter-spacing: .5px; }
        .badge-pending   { background: #ffc107; color: #000; }
        .badge-processing{ background: #0dcaf0; color: #000; }
        .badge-shipped   { background: #0d6efd; }
        .badge-delivered { background: #198754; }
        .badge-cancelled { background: #dc3545; }
        @media (max-width:768px) { .sidebar { width: 100%; min-height: auto; position: relative; } .main-content { margin-left: 0; } }
    </style>
</head>
<body>
<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-brand">
        <i class="bi bi-shop me-2"></i>{{ $settings->site_name }}
        <div style="font-size:.7rem;color:#6c8ebf;font-weight:400">Admin Panel</div>
    </div>
    <nav class="mt-2">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i> Categories
        </a>
        <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Products
        </a>
        <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
            <i class="bi bi-bag-check"></i> Orders
        </a>
        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Users
        </a>
        <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i> White Label Settings
        </a>
        <hr style="border-color:#2d3d50;margin:8px 0">
        <a href="{{ route('home') }}" class="nav-link" target="_blank">
            <i class="bi bi-eye"></i> View Site
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link border-0 w-100 text-start bg-transparent">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </nav>
</div>

<!-- Main -->
<div class="main-content">
    <div class="topbar">
        <h5 class="mb-0 fw-bold">@yield('title', 'Dashboard')</h5>
        <div class="text-muted small">
            <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
        </div>
    </div>

    @foreach(['success','error','warning'] as $t)
        @if(session($t))
            <div class="alert alert-{{ $t==='error'?'danger':$t }} alert-dismissible fade show">
                {{ session($t) }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    @endforeach

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
