<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name','nama','email','password','no_hp','role','dinas_id'];

    protected $hidden = ['password','remember_token'];
    protected $casts = ['email_verified_at' => 'datetime','password' => 'hashed'];

    public function dinas()         { return $this->belongsTo(Dinas::class); }
    public function laporans()      { return $this->hasMany(Laporan::class); }
    public function dukungan()      { return $this->hasMany(DukunganLaporan::class); }
    public function komentars()     { return $this->hasMany(KomentarLaporan::class); }
    public function riwayatProgres(){ return $this->hasMany(RiwayatProgres::class, 'petugas_id'); }

    public function isAdmin()   { return $this->role === 'admin'; }
    public function isPetugas() { return $this->role === 'petugas'; }
    public function isWarga()   { return $this->role === 'warga'; }
}