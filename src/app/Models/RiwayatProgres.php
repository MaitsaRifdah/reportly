<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RiwayatProgres extends Model
{
    protected $table = 'riwayat_progres';
    protected $fillable = ['laporan_id','petugas_id','status_baru','catatan_progres','foto_penyelesaian'];

    public function laporan() { return $this->belongsTo(Laporan::class); }
    public function petugas() { return $this->belongsTo(User::class,'petugas_id'); }
}