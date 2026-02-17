@extends('layouts.admin')
@section('title','Users')
@section('content')
<form method="GET" class="d-flex gap-2 mb-3">
<input type="text" name="search" class="form-control form-control-sm" placeholder="Search name or email..." value="{{ request('search') }}" style="width:250px">
<button class="btn btn-outline-secondary btn-sm"><i class="bi bi-search"></i></button>
</form>
<div class="card border-0 shadow-sm">
<div class="table-responsive">
<table class="table mb-0">
<thead><tr><th>#</th><th>Name</th><th>Email</th><th>Phone</th><th>Orders</th><th>Joined</th><th></th></tr></thead>
<tbody>
@forelse($users as $user)
<tr>
<td>{{ $user->id }}</td>
<td class="fw-semibold">{{ $user->name }}</td>
<td>{{ $user->email }}</td>
<td>{{ $user->phone ?? '—' }}</td>
<td><span class="badge bg-secondary">{{ $user->orders_count ?? 0 }}</span></td>
<td>{{ $user->created_at->format('M d, Y') }}</td>
<td>
<a href="{{ route('admin.users.show',$user) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
</td>
</tr>
@empty
<tr><td colspan="7" class="text-center text-muted py-4">No users found.</td></tr>
@endforelse
</tbody>
</table>
</div>
</div>
<div class="mt-3">{{ $users->links() }}</div>
@endsection
