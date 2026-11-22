<?php
namespace Database\Seeders;

use App\Models\Dinas;
use App\Models\KategoriFasilitas;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Dinas
        $pu  = Dinas::create(['nama_dinas'=>'Dinas PU','deskripsi'=>'Pekerjaan Umum','kontak_dinas'=>'021-111']);
        $dlh = Dinas::create(['nama_dinas'=>'DLH','deskripsi'=>'Lingkungan Hidup','kontak_dinas'=>'021-222']);
        $dishub = Dinas::create(['nama_dinas'=>'Dinas Perhubungan','deskripsi'=>'Transportasi','kontak_dinas'=>'021-333']);

        // Kategori
        KategoriFasilitas::create(['nama_kategori'=>'Jalan Rusak','ikon'=>'road','dinas_default_id'=>$pu->id]);
        KategoriFasilitas::create(['nama_kategori'=>'Lampu Jalan','ikon'=>'lightbulb','dinas_default_id'=>$dishub->id]);
        KategoriFasilitas::create(['nama_kategori'=>'Sampah','ikon'=>'trash','dinas_default_id'=>$dlh->id]);
        KategoriFasilitas::create(['nama_kategori'=>'Drainase','ikon'=>'water','dinas_default_id'=>$pu->id]);
        KategoriFasilitas::create(['nama_kategori'=>'Taman & Halte','ikon'=>'tree','dinas_default_id'=>$dishub->id]);

        // Users
        User::create(['name'=>'Admin Pemda','email'=>'admin@reportly.test',
            'password'=>Hash::make('password'),'role'=>'admin','no_hp'=>'081111111']);
        User::create(['name'=>'Petugas PU','email'=>'petugas@reportly.test',
            'password'=>Hash::make('password'),'role'=>'petugas','dinas_id'=>$pu->id,'no_hp'=>'082222222']);
        User::create(['name'=>'Warga Contoh','email'=>'warga@reportly.test',
            'password'=>Hash::make('password'),'role'=>'warga','no_hp'=>'083333333']);
    }
}