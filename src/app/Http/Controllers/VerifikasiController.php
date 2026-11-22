<?php
namespace App\Http\Controllers;

use App\Models\Dinas;
use App\Models\Laporan;
use App\Notifications\StatusLaporanUpdated;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index()
    {
        $laporans = Laporan::where('status', 'menunggu')->latest()->paginate(10);
        return view('admin.verifikasi_index', compact('laporans'));
    }

    public function verifikasi(Request $request, Laporan $laporan)
    {
        $data = $request->validate([
            'prioritas' => 'required|in:rendah,sedang,tinggi',
            'dinas_id'  => 'required|exists:dinas,id',
        ]);
        $laporan->update([
            'status'    => 'diverifikasi',
            'prioritas' => $data['prioritas'],
            'dinas_id'  => $data['dinas_id'],
        ]);
        $laporan->user->notify(new StatusLaporanUpdated($laporan));
        return back()->with('success', 'Laporan diverifikasi & didisposisi.');
    }

    public function tolak(Request $request, Laporan $laporan)
    {
        $data = $request->validate(['alasan_ditolak' => 'required|string']);
        $laporan->update([
            'status'         => 'ditolak',
            'alasan_ditolak' => $data['alasan_ditolak'],
        ]);
        $laporan->user->notify(new StatusLaporanUpdated($laporan));
        return back()->with('success', 'Laporan ditolak.');
    }
}