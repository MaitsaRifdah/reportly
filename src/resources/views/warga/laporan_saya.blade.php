@extends('layouts.app')
@section('content')
<h3>Laporan Saya</h3>
<table class="table table-striped">
    <thead><tr><th>Kode</th><th>Judul</th><th>Kategori</th><th>Status</th><th>Aksi</th></tr></thead>
    <tbody>
        @foreach($laporans as $l)
        <tr>
            <td>{{ $l->kode_tiket }}</td>
            <td>{{ $l->judul }}</td>
            <td>{{ $l->kategori->nama_kategori ?? '-' }}</td>
            <td><span class="badge bg-info">{{ $l->status }}</span></td>
            <td><a href="{{ route('laporan.show',$l) }}" class="btn btn-sm btn-outline-primary">Detail</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $laporans->links() }}
@endsection