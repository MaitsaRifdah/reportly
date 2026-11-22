<?php
namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function warga()
    {
        $laporans = Laporan::where('user_id', auth()->id())->latest()->take(5)->get();
        return view('warga.dashboard', compact('laporans'));
    }

    public function admin()
    {
        $total        = Laporan::count();
        $menunggu     = Laporan::where('status','menunggu')->count();
        $selesai      = Laporan::where('status','selesai')->count();
        $perKategori  = Laporan::select('kategori_id', DB::raw('count(*) as total'))
                                ->groupBy('kategori_id')->with('kategori')->get();
        return view('admin.dashboard', compact('total','menunggu','selesai','perKategori'));
    }

    public function petugas()
    {
        $dinasId = auth()->user()->dinas_id;
        $tugas   = Laporan::where('dinas_id', $dinasId)->latest()->take(10)->get();
        return view('petugas.dashboard', compact('tugas'));
    }
}