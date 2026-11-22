@extends('layouts.app')
@section('content')
<h3>Dashboard Warga</h3>
<a href="{{ route('warga.laporan.create') }}" class="btn btn-primary mb-3">+ Buat Laporan</a>
<div class="card">
    <div class="card-body">
        <h5>Laporan Terbaru Saya</h5>
        <table class="table table-striped">
            <thead><tr><th>Kode</th><th>Judul</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($laporans as $l)
                <tr>
                    <td>{{ $l->kode_tiket }}</td>
                    <td>{{ $l->judul }}</td>
                    <td><span class="badge bg-info">{{ $l->status }}</span></td>
                    <td><a href="{{ route('laporan.show',$l) }}" class="btn btn-sm btn-outline-primary">Detail</a></td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">Belum ada laporan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection