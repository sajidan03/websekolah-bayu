<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('profils', function (Blueprint $table) {
            $table->integer('tahun_berdiri')->nullable()->after('isi_misi');
            $table->integer('jumlah_siswa')->nullable()->after('tahun_berdiri');
            $table->integer('lulusan_sukes')->nullable()->after('jumlah_siswa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profils', function (Blueprint $table) {
            $table->dropColumn(['tahun_berdiri', 'jumlah_siswa', 'lulusan_sukes']);
        });
    }
};
