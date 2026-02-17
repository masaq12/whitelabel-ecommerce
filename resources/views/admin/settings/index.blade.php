@extends('layouts.admin')
@section('title','White Label Settings')
@section('content')
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card border-0 shadow-sm">
<div class="card-body">
<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
@csrf
<div class="row g-3">
<div class="col-12">
<h6 class="fw-bold text-muted text-uppercase small mb-2">Branding</h6>
</div>
<div class="col-md-8">
<label class="form-label fw-semibold">Site Name *</label>
<input type="text" name="site_name" class="form-control @error('site_name') is-invalid @enderror"
       value="{{ old('site_name', $settings->site_name) }}" required>
@error('site_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-md-4">
<label class="form-label fw-semibold">Logo</label>
@if($settings->logo)
<div class="mb-2"><img src="{{ Storage::url($settings->logo) }}" style="max-height:50px"></div>
@endif
<input type="file" name="logo" class="form-control" accept="image/*">
<div class="form-text">SVG, PNG, JPG (max 2MB)</div>
</div>
<div class="col-12"><hr class="my-1"></div>
<div class="col-12">
<h6 class="fw-bold text-muted text-uppercase small mb-2">Theme Colors</h6>
</div>
<div class="col-md-6">
<label class="form-label fw-semibold">Primary Color</label>
<div class="input-group">
<input type="color" name="primary_color" class="form-control form-control-color"
       value="{{ old('primary_color', $settings->primary_color ?? '#007bff') }}">
<input type="text" class="form-control" value="{{ $settings->primary_color ?? '#007bff' }}" readonly
       id="primary_preview">
</div>
</div>
<div class="col-md-6">
<label class="form-label fw-semibold">Secondary Color</label>
<div class="input-group">
<input type="color" name="secondary_color" class="form-control form-control-color"
       value="{{ old('secondary_color', $settings->secondary_color ?? '#6c757d') }}">
<input type="text" class="form-control" value="{{ $settings->secondary_color ?? '#6c757d' }}" readonly
       id="secondary_preview">
</div>
</div>
<div class="col-12"><hr class="my-1"></div>
<div class="col-12">
<h6 class="fw-bold text-muted text-uppercase small mb-2">Contact Info</h6>
</div>
<div class="col-md-6">
<label class="form-label fw-semibold">Contact Email</label>
<input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $settings->contact_email) }}">
</div>
<div class="col-md-6">
<label class="form-label fw-semibold">Contact Phone</label>
<input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', $settings->contact_phone) }}">
</div>
<div class="col-12">
<label class="form-label fw-semibold">Footer Text</label>
<input type="text" name="footer_text" class="form-control" value="{{ old('footer_text', $settings->footer_text) }}">
</div>
<div class="col-12 mt-2">
<button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-2"></i>Save Settings</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
@section('scripts')
<script>
document.querySelector('[name=primary_color]').addEventListener('input', function(){
    document.getElementById('primary_preview').value = this.value;
});
document.querySelector('[name=secondary_color]').addEventListener('input', function(){
    document.getElementById('secondary_preview').value = this.value;
});
</script>
@endsection
@endsection
