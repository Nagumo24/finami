<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $blueprint) {
            // Menambahkan kolom pengeluaran wajib bulanan dengan default Rp3.000.000
            $blueprint->decimal('pengeluaran_wajib', 15, 2)->default(3000000)->after('email');
            // Menambahkan kolom level finansial pengguna
            $blueprint->string('level_finansial')->default('Bertahan')->after('pengeluaran_wajib');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $blueprint) {
            $blueprint->dropColumn(['pengeluaran_wajib', 'level_finansial']);
        });
    }
};
