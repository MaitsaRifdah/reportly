<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DukunganLaporan extends Model
{
    protected $table = 'dukungan_laporans';
    protected $fillable = ['laporan_id','user_id'];

    public function laporan() { return $this->belongsTo(Laporan::class); }
    public function user()    { return $this->belongsTo(User::class); }
}