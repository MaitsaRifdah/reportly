<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reportly — {{ $title ?? 'Sistem Pelaporan Fasilitas Umum' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet">
    <style>
        body { background:#f5f6fa; }
        .sidebar { min-height:100vh; background:#1e3a8a; color:#fff; }
        .sidebar a { color:#cbd5e1; text-decoration:none; display:block; padding:10px 18px; }
        .sidebar a:hover, .sidebar a.active { background:#1d4ed8; color:#fff; }
        .card-stat { border-left:4px solid #1d4ed8; }
        #map { height: 350px; border-radius:8px; }
    </style>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="/">📢 Reportly</a>
        @auth
        <div class="text-white">
            {{ auth()->user()->name }} ({{ auth()->user()->role }})
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-sm btn-outline-light">Logout</button>
            </form>
        </div>
        @endauth
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        @auth
        <div class="col-md-2 p-0 sidebar">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-10 py-3">
        @else
        <div class="col-md-12 py-3">
        @endauth
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@stack('scripts')
</body>
</html>