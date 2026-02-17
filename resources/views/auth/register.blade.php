@extends('layouts.app')
@section('title','Register')
@section('content')
<div class="row justify-content-center">
<div class="col-md-6">
<div class="card shadow-sm border-0 rounded-3">
<div class="card-body p-4">
<h4 class="fw-bold mb-4 text-center"><i class="bi bi-person-plus me-2"></i>Create Account</h4>
<form method="POST" action="{{ route('register') }}">
@csrf
<div class="row g-3">
<div class="col-12">
<label class="form-label fw-semibold">Full Name *</label>
<input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
       value="{{ old('name') }}" required placeholder="John Doe">
@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-12">
<label class="form-label fw-semibold">Email Address *</label>
<input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
       value="{{ old('email') }}" required placeholder="you@example.com">
@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-md-6">
<label class="form-label fw-semibold">Password *</label>
<input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
       required placeholder="Min 8 characters">
@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-md-6">
<label class="form-label fw-semibold">Confirm Password *</label>
<input type="password" name="password_confirmation" class="form-control" required placeholder="Repeat password">
</div>
<div class="col-12">
<label class="form-label fw-semibold">Phone Number</label>
<input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="+1 (555) 000-0000">
</div>
<div class="col-12 mt-2">
<button type="submit" class="btn btn-primary w-100 py-2">
    <i class="bi bi-person-check me-2"></i>Create Account
</button>
</div>
</div>
</form>
<hr class="my-3">
<p class="text-center mb-0 text-muted">Already have an account? <a href="{{ route('login') }}" class="fw-semibold">Sign in</a></p>
</div>
</div>
</div>
</div>
@endsection
