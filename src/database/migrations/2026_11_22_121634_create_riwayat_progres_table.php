<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('riwayat_progres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_id')->constrained('laporans')->cascadeOnDelete();
            $table->foreignId('petugas_id')->constrained('users')->cascadeOnDelete();
            $table->string('status_baru');
            $table->text('catatan_progres');
            $table->string('foto_penyelesaian')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('riwayat_progres'); }
};