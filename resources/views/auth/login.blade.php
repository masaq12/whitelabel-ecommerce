@extends('layouts.app')
@section('title','Login')
@section('content')
<div class="row justify-content-center">
<div class="col-md-5">
<div class="card shadow-sm border-0 rounded-3">
<div class="card-body p-4">
<h4 class="fw-bold mb-4 text-center"><i class="bi bi-box-arrow-in-right me-2"></i>Sign In</h4>
<form method="POST" action="{{ route('login') }}">
@csrf
<div class="mb-3">
<label class="form-label fw-semibold">Email Address</label>
<input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
       value="{{ old('email') }}" required autofocus placeholder="you@example.com">
@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
<label class="form-label fw-semibold">Password</label>
<input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
       required placeholder="••••••••">
@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
    Don't have an account? <a href="{{ route('register') }}" class="fw-semibold">Register here</a>
</p>
</div>
</div>
<p class="text-center text-muted small mt-3">
    <strong>Demo:</strong> user@example.com / password123
</p>
</div>
</div>
@endsection
