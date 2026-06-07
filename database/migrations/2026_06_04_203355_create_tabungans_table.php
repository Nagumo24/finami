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
    Schema::create('tabungans', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal');
        $table->decimal('jumlah', 12, 2); // Menggunakan decimal untuk akurasi uang
        $table->string('sumber'); // Contoh: Gaji, Bonus, Freelance
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabungans');
    }
};
