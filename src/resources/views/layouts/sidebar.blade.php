<h5 class="p-3 border-bottom border-secondary">Menu</h5>
@if(auth()->user()->isWarga())
    <a href="{{ route('warga.dashboard') }}">🏠 Dashboard</a>
    <a href="{{ route('warga.laporan.create') }}">➕ Buat Laporan</a>
    <a href="{{ route('warga.laporan.saya') }}">📄 Laporan Saya</a>
    <a href="{{ route('laporan.public') }}">🌐 Laporan Publik</a>
@elseif(auth()->user()->isAdmin())
    <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
    <a href="{{ route('admin.verifikasi.index') }}">✅ Verifikasi</a>
    <a href="{{ route('admin.kategori.index') }}">🏷️ Kategori</a>
    <a href="{{ route('admin.dinas.index') }}">🏢 Dinas</a>
    <a href="{{ route('admin.user.index') }}">👥 Users</a>
    <a href="{{ route('admin.export.pdf') }}">🖨️ Export PDF</a>
    <a href="{{ route('admin.export.excel') }}">📗 Export Excel</a>
@elseif(auth()->user()->isPetugas())
    <a href="{{ route('petugas.dashboard') }}">📊 Dashboard</a>
    <a href="{{ route('petugas.daftar_tugas') }}">📋 Daftar Tugas</a>
@endif