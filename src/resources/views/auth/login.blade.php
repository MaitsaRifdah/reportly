@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="mb-3">Login Reportly</h4>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button class="btn btn-primary w-100">Login</button>
                </form>
                <p class="mt-3 text-center">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
            </div>
        </div>
    </div>
</div>
@endsection