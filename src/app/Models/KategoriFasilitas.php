<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class KategoriFasilitas extends Model
{
    protected $table = 'kategori_fasilitas';
    protected $fillable = ['nama_kategori','ikon','dinas_default_id'];

    public function dinasDefault() { return $this->belongsTo(Dinas::class,'dinas_default_id'); }
    public function laporans()     { return $this->hasMany(Laporan::class,'kategori_id'); }
}