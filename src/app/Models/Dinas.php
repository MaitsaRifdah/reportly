<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Dinas extends Model
{
    protected $table = 'dinas';
    protected $fillable = ['nama_dinas','deskripsi','kontak_dinas'];

    public function users()       { return $this->hasMany(User::class); }
    public function kategori()    { return $this->hasMany(KategoriFasilitas::class, 'dinas_default_id'); }
    public function laporans()    { return $this->hasMany(Laporan::class); }
}