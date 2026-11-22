<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('kategori_fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
            $table->string('ikon')->nullable();
            $table->foreignId('dinas_default_id')->nullable()
                  ->constrained('dinas')->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('kategori_fasilitas'); }
};