@extends('layouts.app')
@section('content')
<h3>Dashboard Admin</h3>
<div class="row mb-3">
    <div class="col-md-4"><div class="card card-stat p-3">
        <b>Total Laporan</b><h2>{{ $total }}</h2></div></div>
    <div class="col-md-4"><div class="card card-stat p-3">
        <b>Menunggu</b><h2>{{ $menunggu }}</h2></div></div>
    <div class="col-md-4"><div class="card card-stat p-3">
        <b>Selesai</b><h2>{{ $selesai }}</h2></div></div>
</div>
<div class="card"><div class="card-body">
    <h5>Per Kategori</h5>
    <table class="table">
        <thead><tr><th>Kategori</th><th>Total</th></tr></thead>
        <tbody>
        @foreach($perKategori as $p)
            <tr><td>{{ $p->kategori->nama_kategori ?? '-' }}</td><td>{{ $p->total }}</td></tr>
        @endforeach
        </tbody>
    </table>
</div></div>
@endsection