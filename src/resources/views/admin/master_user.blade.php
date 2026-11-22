@extends('layouts.app')
@section('content')
<h3>Manajemen User</h3>
<form action="{{ route('admin.user.store') }}" method="POST" class="row g-2 mb-3">
    @csrf
    <div class="col"><input name="name" class="form-control" placeholder="Nama" required></div>
    <div class="col"><input name="email" type="email" class="form-control" placeholder="Email" required></div>
    <div class="col"><input name="password" type="password" class="form-control" placeholder="Password" required></div>
    <div class="col"><select name="role" class="form-select">
        <option value="warga">Warga</option><option value="petugas">Petugas</option><option value="admin">Admin</option>
    </select></div>
    <div class="col"><select name="dinas_id" class="form-select">
        <option value="">-- Dinas (untuk petugas) --</option>
        @foreach($dinas as $d)<option value="{{ $d->id }}">{{ $d->nama_dinas }}</option>@endforeach
    </select></div>
    <div class="col-auto"><button class="btn btn-primary">Tambah</button></div>
</form>
<table class="table table-bordered">
    <thead><tr><th>Nama</th><th>Email</th><th>Role</th><th>Dinas</th><th>Aksi</th></tr></thead>
    <tbody>
    @foreach($users as $u)
    <tr>
        <td>{{ $u->name }}</td><td>{{ $u->email }}</td>
        <td><span class="badge bg-secondary">{{ $u->role }}</span></td>
        <td>{{ $u->dinas->nama_dinas ?? '-' }}</td>
        <td>
            <form action="{{ route('admin.user.destroy',$u) }}" method="POST">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection