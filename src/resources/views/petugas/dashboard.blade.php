@extends('layouts.app')
@section('content')
<h3>Dashboard Petugas</h3>
<a href="{{ route('petugas.daftar_tugas') }}" class="btn btn-primary">Lihat Daftar Tugas</a>
@endsection