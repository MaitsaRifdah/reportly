@extends('layouts.app')
@section('content')
<h3>Verifikasi Laporan</h3>
@foreach($laporans as $l)
<div class="card mb-3"><div class="card-body">
    <h5>{{ $l->judul }} <small class="text-muted">({{ $l->kode_tiket }})</small></h5>
    <p>{{ $l->deskripsi }} — <i>{{ $l->alamat_lokasi }}</i></p>

    <form action="{{ route('admin.verifikasi.aksi',$l) }}" method="POST" class="d-inline">
        @csrf
        <select name="prioritas" class="form-select d-inline w-auto">
            <option value="rendah">Rendah</option>
            <option value="sedang">Sedang</option>
            <option value="tinggi">Tinggi</option>
        </select>
        <select name="dinas_id" class="form-select d-inline w-auto">
            @foreach(\App\Models\Dinas::all() as $d)
                <option value="{{ $d->id }}">{{ $d->nama_dinas }}</option>
            @endforeach
        </select>
        <button class="btn btn-success btn-sm">Verifikasi & Disposisi</button>
    </form>

    <form action="{{ route('admin.verifikasi.tolak',$l) }}" method="POST" class="mt-2">
        @csrf
        <input name="alasan_ditolak" class="form-control mb-2" placeholder="Alasan ditolak..." required>
        <button class="btn btn-danger btn-sm">Tolak</button>
    </form>
</div></div>
@endforeach
{{ $laporans->links() }}
@endsection