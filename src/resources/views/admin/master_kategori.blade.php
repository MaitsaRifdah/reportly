@extends('layouts.app')
@section('content')
<h3>Kategori Fasilitas</h3>
<form action="{{ route('admin.kategori.store') }}" method="POST" class="row g-2 mb-3">
    @csrf
    <div class="col"><input name="nama_kategori" class="form-control" placeholder="Nama Kategori" required></div>
    <div class="col"><input name="ikon" class="form-control" placeholder="Ikon (opsional)"></div>
    <div class="col"><select name="dinas_default_id" class="form-select">
        <option value="">-- Dinas Default --</option>
        @foreach($dinas as $d)<option value="{{ $d->id }}">{{ $d->nama_dinas }}</option>@endforeach
    </select></div>
    <div class="col-auto"><button class="btn btn-primary">Tambah</button></div>
</form>
<table class="table table-bordered">
    <thead><tr><th>Nama</th><th>Ikon</th><th>Dinas Default</th><th>Aksi</th></tr></thead>
    <tbody>
    @foreach($kategori as $k)
    <tr>
        <td>{{ $k->nama_kategori }}</td>
        <td>{{ $k->ikon }}</td>
        <td>{{ $k->dinasDefault->nama_dinas ?? '-' }}</td>
        <td>
            <form action="{{ route('admin.kategori.destroy',$k) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection