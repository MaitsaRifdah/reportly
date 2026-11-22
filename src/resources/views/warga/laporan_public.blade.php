@extends('layouts.app')
@section('content')
<h3>Laporan Publik</h3>
<div class="row">
@foreach($laporans as $l)
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <img src="{{ asset('storage/'.$l->foto_bukti) }}" class="card-img-top" style="height:160px;object-fit:cover">
            <div class="card-body">
                <h6>{{ $l->judul }}</h6>
                <small class="text-muted">{{ $l->kategori->nama_kategori }} — {{ $l->status }}</small>
                <p class="mt-2">{{ Str::limit($l->deskripsi, 80) }}</p>
                <a href="{{ route('laporan.show',$l) }}" class="btn btn-sm btn-primary">Lihat</a>
            </div>
        </div>
    </div>
@endforeach
</div>
{{ $laporans->links() }}
@endsection