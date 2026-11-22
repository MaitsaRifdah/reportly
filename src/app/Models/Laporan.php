<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporans';
    protected $fillable = [
        'kode_tiket','user_id','kategori_id','dinas_id','judul','deskripsi',
        'alamat_lokasi','latitude','longitude','foto_bukti','prioritas','status','alasan_ditolak'
    ];

    public function user()      { return $this->belongsTo(User::class); }
    public function kategori()  { return $this->belongsTo(KategoriFasilitas::class,'kategori_id'); }
    public function dinas()     { return $this->belongsTo(Dinas::class); }
    public function riwayat()   { return $this->hasMany(RiwayatProgres::class)->latest(); }
    public function dukungan()  { return $this->hasMany(DukunganLaporan::class); }
    public function komentars() { return $this->hasMany(KomentarLaporan::class)->latest(); }

    public static function generateKodeTiket(): string {
        return 'RPT-' . strtoupper(uniqid());
    }
}