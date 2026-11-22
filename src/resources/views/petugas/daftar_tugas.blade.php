@extends('layouts.app')
@section('content')
<h3>Daftar Tugas Terdisposisi</h3>
<table class="table table-striped">
    <thead><tr><th>Kode</th><th>Judul</th><th>Prioritas</th><th>Status</th><th>Aksi</th></tr></thead>
    <tbody>
    @foreach($tugas as $t)
    <tr>
        <td>{{ $t->kode_tiket }}</td>
        <td>{{ $t->judul }}</td>
        <td><span class="badge bg-warning">{{ $t->prioritas }}</span></td>
        <td>{{ $t->status }}</td>
        <td><a href="{{ route('petugas.form_progres',$t) }}" class="btn btn-sm btn-primary">Update</a></td>
    </tr>
    @endforeach
    </tbody>
</table>
{{ $tugas->links() }}
@endsection