<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profils', function (Blueprint $table) {
            // gambar_struktur untuk foto per-orang di struktur organisasi
            // gambar sudah ada, dipakai juga untuk struktur
            // pastikan kolom gambar sudah nullable
            if (!Schema::hasColumn('profils', 'gambar')) {
                $table->string('gambar')->nullable();
            }
        });
    }

    public function down(): void
    {
        // tidak perlu drop karena kolom gambar sudah ada sejak awal
    }
};
