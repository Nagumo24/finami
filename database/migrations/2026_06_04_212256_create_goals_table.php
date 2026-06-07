<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->string('nama_target');          // Contoh: Beli Sepatu Safety, PC Baru, dll
            $table->decimal('nominal_target', 15, 2); // Jumlah uang yang harus dikumpulkan
            $table->decimal('nominal_terkumpul', 15, 2)->default(0); // Uang yang sudah disisihkan
            $table->date('tenggat_waktu')->nullable(); // Deadlinenya
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
