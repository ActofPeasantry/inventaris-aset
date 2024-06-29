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
        Schema::create('pengesahan_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('transaksi_id')->references('id')->on('transaksi')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status_pengesahan', ['Disetujui', 'Ditolak', 'Revisi', 'Telah Direvisi'])->default('diterima');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengesahan_transaksi');
    }
};
