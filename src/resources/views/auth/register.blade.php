@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="mb-3">Daftar Akun Warga</h4>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3"><label>Nama</label>
                        <input type="text" name="name" class="form-control" required></div>
                    <div class="mb-3"><label>Email</label>
                        <input type="email" name="email" class="form-control" required></div>
                    <div class="mb-3"><label>No HP</label>
                        <input type="text" name="no_hp" class="form-control" required></div>
                    <div class="mb-3"><label>Password</label>
                        <input type="password" name="password" class="form-control" required></div>
                    <div class="mb-3"><label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required></div>
                    <button class="btn btn-primary w-100">Daftar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection