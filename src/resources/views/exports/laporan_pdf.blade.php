<!DOCTYPE html>
<html><head><meta charset="utf-8">
<style>table{width:100%;border-collapse:collapse;font-size:12px}
th,td{border:1px solid #333;padding:6px;text-align:left}</style></head>
<body>
<h3>Rekap Laporan Reportly</h3>
<table>
    <thead><tr><th>Kode Tiket</th><th>Tanggal</th><th>Pelapor</th><th>Kategori</th><th>Status</th><th>Alamat</th></tr></thead>
    <tbody>
    @foreach($laporans as $l)
    <tr>
        <td>{{ $l->kode_tiket }}</td>
        <td>{{ $l->created_at->format('Y-m-d') }}</td>
        <td>{{ $l->user->name }}</td>
        <td>{{ $l->kategori->nama_kategori ?? '-' }}</td>
        <td>{{ $l->status }}</td>
        <td>{{ $l->alamat_lokasi }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
</body></html>