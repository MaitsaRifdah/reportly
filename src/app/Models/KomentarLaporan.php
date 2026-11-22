<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class KomentarLaporan extends Model
{
    protected $table = 'komentar_laporans';
    protected $fillable = ['laporan_id','user_id','isi_komentar'];

    public function laporan() { return $this->belongsTo(Laporan::class); }
    public function user()    { return $this->belongsTo(User::class); }
}