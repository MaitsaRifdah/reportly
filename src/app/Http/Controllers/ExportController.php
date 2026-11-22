<?php
namespace App\Http\Controllers;

use App\Models\Laporan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function pdf(Request $request)
    {
        $query = Laporan::with(['user','kategori','dinas']);
        if ($request->filled('dari') && $request->filled('sampai')) {
            $query->whereBetween('created_at', [$request->dari, $request->sampai]);
        }
        $laporans = $query->latest()->get();
        $pdf = Pdf::loadView('exports.laporan_pdf', compact('laporans'));
        return $pdf->download('rekap_laporan.pdf');
    }

    public function excel(Request $request)
    {
        // Fallback sederhana: export CSV
        $laporans = Laporan::with(['user','kategori','dinas'])->get();
        $filename = 'rekap_laporan_' . date('Ymd_His') . '.csv';
        $handle   = fopen('php://temp', 'r+');
        fputcsv($handle, ['Kode Tiket','Tanggal','Pelapor','Kategori','Status','Prioritas','Alamat']);
        foreach ($laporans as $l) {
            fputcsv($handle, [
                $l->kode_tiket, $l->created_at->format('Y-m-d'),
                $l->user->name, $l->kategori->nama_kategori,
                $l->status, $l->prioritas, $l->alamat_lokasi,
            ]);
        }
        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        return response($content)
            ->header('Content-Type','text/csv')
            ->header('Content-Disposition', "attachment; filename=$filename");
    }
}