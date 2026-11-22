<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->string('no_hp')->nullable()->after('password');
            $table->enum('role', ['warga', 'petugas', 'admin'])->default('warga')->after('no_hp');
            $table->foreignId('dinas_id')->nullable()->after('role')
                  ->constrained('dinas')->nullOnDelete();
        });
        // Ubah kolom name default Laravel menjadi nullable
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
        });
    }
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['dinas_id']);
            $table->dropColumn(['no_hp', 'role', 'dinas_id']);
        });
    }
};