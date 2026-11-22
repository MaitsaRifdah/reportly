<?php
namespace App\Http\Controllers;

use App\Models\KategoriFasilitas;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::whereIn('status', ['menunggu','diverifikasi','diproses','selesai'])
                           ->latest()->paginate(10);
        return view('warga.laporan_public', compact('laporans'));
    }

    public function create()
    {
        $kategori = KategoriFasilitas::all();
        return view('warga.buat_laporan', compact('kategori'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'         => 'required|string|max:150',
            'deskripsi'     => 'required|string',
            'kategori_id'   => 'required|exists:kategori_fasilitas,id',
            'alamat_lokasi' => 'required|string',
            'latitude'      => 'required|numeric',
            'longitude'     => 'required|numeric',
            'foto_bukti'    => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $data['kode_tiket'] = Laporan::generateKodeTiket();
        $data['user_id']    = auth()->id();
        $data['foto_bukti'] = $request->file('foto_bukti')->store('laporans', 'public');

        Laporan::create($data);
        return redirect()->route('warga.laporan.saya')
                         ->with('success', 'Laporan berhasil dibuat!');
    }

    public function saya()
    {
        $laporans = Laporan::where('user_id', auth()->id())->latest()->paginate(10);
        return view('warga.laporan_saya', compact('laporans'));
    }

    public function show(Laporan $laporan)
    {
        $laporan->load(['kategori','dinas','user','riwayat.petugas','komentars.user','dukungan']);
        return view('warga.detail_laporan', compact('laporan'));
    }
}