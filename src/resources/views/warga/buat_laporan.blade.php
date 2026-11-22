@extends('layouts.app')
@section('content')
<h3>Buat Laporan Baru</h3>
<form action="{{ route('warga.laporan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3"><label>Judul</label>
                <input name="judul" class="form-control" required></div>
            <div class="mb-3"><label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required></textarea></div>
            <div class="mb-3"><label>Kategori Fasilitas</label>
                <select name="kategori_id" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select></div>
            <div class="mb-3"><label>Alamat Lokasi</label>
                <textarea name="alamat_lokasi" class="form-control" rows="2" required></textarea></div>
            <div class="row">
                <div class="col"><label>Latitude</label>
                    <input name="latitude" id="lat" class="form-control" readonly required></div>
                <div class="col"><label>Longitude</label>
                    <input name="longitude" id="lng" class="form-control" readonly required></div>
            </div>
            <div class="mb-3 mt-3"><label>Foto Bukti</label>
                <input type="file" name="foto_bukti" class="form-control" accept="image/*" required></div>
            <button class="btn btn-primary">Kirim Laporan</button>
        </div>
        <div class="col-md-6">
            <label class="form-label">Klik peta untuk memilih lokasi:</label>
            <div id="map"></div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    const map = L.map('map').setView([-6.2, 106.816], 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    let marker;
    map.on('click', function(e) {
        if (marker) map.removeLayer(marker);
        marker = L.marker(e.latlng).addTo(map);
        document.getElementById('lat').value = e.latlng.lat.toFixed(8);
        document.getElementById('lng').value = e.latlng.lng.toFixed(8);
    });
</script>
@endpush