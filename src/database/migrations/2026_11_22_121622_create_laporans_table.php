<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tiket')->unique();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('kategori_id')->constrained('kategori_fasilitas')->cascadeOnDelete();
            $table->foreignId('dinas_id')->nullable()
                  ->constrained('dinas')->nullOnDelete();
            $table->string('judul');
            $table->text('deskripsi');
            $table->text('alamat_lokasi');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('foto_bukti');
            $table->enum('prioritas', ['rendah','sedang','tinggi'])->nullable();
            $table->enum('status', ['menunggu','diverifikasi','diproses','selesai','ditolak'])
                  ->default('menunggu');
            $table->text('alasan_ditolak')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('laporans'); }
};