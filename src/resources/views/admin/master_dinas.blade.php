@extends('layouts.app')
@section('content')
<h3>Dinas</h3>
<form action="{{ route('admin.dinas.store') }}" method="POST" class="row g-2 mb-3">
    @csrf
    <div class="col"><input name="nama_dinas" class="form-control" placeholder="Nama Dinas" required></div>
    <div class="col"><input name="kontak_dinas" class="form-control" placeholder="Kontak" required></div>
    <div class="col"><input name="deskripsi" class="form-control" placeholder="Deskripsi"></div>
    <div class="col-auto"><button class="btn btn-primary">Tambah</button></div>
</form>
<table class="table table-bordered">
    <thead><tr><th>Nama</th><th>Kontak</th><th>Deskripsi</th><th>Aksi</th></tr></thead>
    <tbody>
    @foreach($dinas as $d)
    <tr>
        <td>{{ $d->nama_dinas }}</td>
        <td>{{ $d->kontak_dinas }}</td>
        <td>{{ $d->deskripsi }}</td>
        <td>
            <form action="{{ route('admin.dinas.destroy',$d) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection