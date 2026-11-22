<?php
namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\RiwayatProgres;
use App\Notifications\StatusLaporanUpdated;
use Illuminate\Http\Request;

class PenangananController extends Controller
{
    public function index()
    {
        $tugas = Laporan::where('dinas_id', auth()->user()->dinas_id)
                        ->whereIn('status', ['diverifikasi','diproses'])
                        ->orderByRaw("FIELD(prioritas,'tinggi','sedang','rendah')")
                        ->latest()->paginate(10);
        return view('petugas.daftar_tugas', compact('tugas'));
    }

    public function formProgres(Laporan $laporan)
    {
        return view('petugas.form_progres', compact('laporan'));
    }

    public function simpanProgres(Request $request, Laporan $laporan)
    {
        $data = $request->validate([
            'status_baru'      => 'required|in:diproses,selesai',
            'catatan_progres'  => 'required|string',
            'foto_penyelesaian'=> 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('foto_penyelesaian')) {
            $data['foto_penyelesaian'] = $request->file('foto_penyelesaian')
                                                  ->store('penyelesaian', 'public');
        }

        $data['laporan_id'] = $laporan->id;
        $data['petugas_id'] = auth()->id();
        RiwayatProgres::create($data);

        $laporan->update(['status' => $data['status_baru']]);
        $laporan->user->notify(new StatusLaporanUpdated($laporan));

        return redirect()->route('petugas.daftar_tugas')
                         ->with('success', 'Progres berhasil disimpan.');
    }
}