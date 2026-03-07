<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prestasis', function (Blueprint $table) {
            if (!Schema::hasColumn('prestasis', 'kategori')) {
                $table->string('kategori')->default('Non-Akademik')->after('isi');
            }
            if (!Schema::hasColumn('prestasis', 'status')) {
                $table->boolean('status')->default(true)->after('foto');
            }
        });
    }

    public function down(): void
    {
        Schema::table('prestasis', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'status']);
        });
    }
};
