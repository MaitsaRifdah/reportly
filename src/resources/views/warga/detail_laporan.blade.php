@extends('layouts.app')
@section('content')
<h3>{{ $laporan->judul }}</h3>
<p><b>Kode Tiket:</b> {{ $laporan->kode_tiket }} | <b>Status:</b> {{ $laporan->status }}</p>
<div class="row">
    <div class="col-md-7">
        <div class="card mb-3"><div class="card-body">
            <p><b>Pelapor:</b> {{ $laporan->user->name }}</p>
            <p><b>Kategori:</b> {{ $laporan->kategori->nama_kategori }}</p>
            <p><b>Alamat:</b> {{ $laporan->alamat_lokasi }}</p>
            <p>{{ $laporan->deskripsi }}</p>
            <img src="{{ asset('storage/'.$laporan->foto_bukti) }}" class="img-fluid rounded">
        </div></div>

        <div class="card mb-3"><div class="card-body">
            <h6>Timeline Progres</h6>
            <ul class="list-group list-group-flush">
            @foreach($laporan->riwayat as $r)
                <li class="list-group-item">
                    <b>{{ $r->status_baru }}</b> — {{ $r->catatan_progres }}
                    <br><small class="text-muted">{{ $r->created_at }} oleh {{ $r->petugas->name }}</small>
                    @if($r->foto_penyelesaian)
                        <br><img src="{{ asset('storage/'.$r->foto_penyelesaian) }}" width="150" class="mt-2 rounded">
                    @endif
                </li>
            @endforeach
            </ul>
        </div></div>

        <div class="card mb-3"><div class="card-body">
            <h6>Diskusi ({{ $laporan->komentars->count() }})</h6>
            @foreach($laporan->komentars as $k)
                <p><b>{{ $k->user->name }}:</b> {{ $k->isi_komentar }}</p>
            @endforeach
            <form action="{{ route('laporan.komentar',$laporan) }}" method="POST">
                @csrf
                <textarea name="isi_komentar" class="form-control mb-2" required></textarea>
                <button class="btn btn-sm btn-primary">Kirim Komentar</button>
            </form>
        </div></div>
    </div>
    <div class="col-md-5">
        <div id="map"></div>
        <form action="{{ route('laporan.upvote',$laporan) }}" method="POST" class="mt-2">
            @csrf
            <button class="btn btn-danger w-100">❤️ Dukung ({{ $laporan->dukungan->count() }})</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const map = L.map('map').setView([{{ $laporan->latitude }}, {{ $laporan->longitude }}], 16);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    L.marker([{{ $laporan->latitude }}, {{ $laporan->longitude }}]).addTo(map);
</script>
@endpush