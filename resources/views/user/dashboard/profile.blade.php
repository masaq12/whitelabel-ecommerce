@extends('layouts.app')
@section('title','My Profile')
@section('content')
<h4 class="fw-bold mb-4"><i class="bi bi-person-circle me-2"></i>My Profile</h4>
<div class="row g-4">
<div class="col-md-7">
<div class="card border-0 shadow-sm mb-4">
<div class="card-body">
<h5 class="fw-bold mb-3">Personal Information</h5>
<form method="POST" action="{{ route('user.profile.update') }}">
@csrf
<div class="row g-3">
<div class="col-12">
<label class="form-label">Full Name *</label>
<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$user->name) }}" required>
@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-md-6">
<label class="form-label">Email</label>
<input type="email" class="form-control" value="{{ $user->email }}" readonly>
</div>
<div class="col-md-6">
<label class="form-label">Phone</label>
<input type="text" name="phone" class="form-control" value="{{ old('phone',$user->phone) }}">
</div>
<div class="col-12">
<label class="form-label">Address</label>
<input type="text" name="address" class="form-control" value="{{ old('address',$user->address) }}">
</div>
<div class="col-md-5">
<label class="form-label">City</label>
<input type="text" name="city" class="form-control" value="{{ old('city',$user->city) }}">
</div>
<div class="col-md-4">
<label class="form-label">State</label>
<input type="text" name="state" class="form-control" value="{{ old('state',$user->state) }}">
</div>
<div class="col-md-3">
<label class="form-label">ZIP</label>
<input type="text" name="zip_code" class="form-control" value="{{ old('zip_code',$user->zip_code) }}">
</div>
<div class="col-12">
<button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i>Save Changes</button>
</div>
</div>
</form>
</div>
</div>
<div class="card border-0 shadow-sm">
<div class="card-body">
<h5 class="fw-bold mb-3"><i class="bi bi-key me-2"></i>Change Password</h5>
<form method="POST" action="{{ route('user.password.change') }}">
@csrf
<div class="row g-3">
<div class="col-12">
<label class="form-label">Current Password *</label>
<input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
@error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-md-6">
<label class="form-label">New Password *</label>
<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-md-6">
<label class="form-label">Confirm New Password *</label>
<input type="password" name="password_confirmation" class="form-control" required>
</div>
<div class="col-12">
<button type="submit" class="btn btn-warning"><i class="bi bi-lock me-2"></i>Update Password</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
@endsection
