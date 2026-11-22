@extends('layouts.app')
@section('content')
<h3>Update Progres: {{ $laporan->judul }}</h3>
<form action="{{ route('petugas.simpan_progres',$laporan) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3"><label>Status Baru</label>
        <select name="status_baru" class="form-select" required>
            <option value="diproses">Diproses</option>
            <option value="selesai">Selesai</option>
        </select></div>
    <div class="mb-3"><label>Catatan</label>
        <textarea name="catatan_progres" class="form-control" rows="3" required></textarea></div>
    <div class="mb-3"><label>Foto Penyelesaian</label>
        <input type="file" name="foto_penyelesaian" class="form-control" accept="image/*"></div>
    <button class="btn btn-primary">Simpan Progres</button>
</form>
@endsection