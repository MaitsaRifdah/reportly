<?php
namespace App\Http\Controllers;

use App\Models\DukunganLaporan;
use App\Models\KomentarLaporan;
use App\Models\Laporan;
use Illuminate\Http\Request;

class InteraksiController extends Controller
{
    public function upvote(Laporan $laporan)
    {
        $existing = DukunganLaporan::where('laporan_id', $laporan->id)
                                   ->where('user_id', auth()->id())->first();
        if ($existing) {
            $existing->delete();
            return back()->with('success', 'Dukungan dibatalkan.');
        }
        DukunganLaporan::create(['laporan_id' => $laporan->id, 'user_id' => auth()->id()]);
        return back()->with('success', 'Dukungan ditambahkan.');
    }

    public function komentar(Request $request, Laporan $laporan)
    {
        $data = $request->validate(['isi_komentar' => 'required|string|max:1000']);
        KomentarLaporan::create([
            'laporan_id'   => $laporan->id,
            'user_id'      => auth()->id(),
            'isi_komentar' => $data['isi_komentar'],
        ]);
        return back()->with('success', 'Komentar terkirim.');
    }
}