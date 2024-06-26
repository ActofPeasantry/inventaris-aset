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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->enum('tujuan_transaksi', ['pengaadaan aset baru', 'pengaduan aset rusak']);
            $table->string('invoice_transaksi')->nullable(true);
            $table->enum('status_transaksi', ['Sedang Proses', 'Selesai', 'Batal'])->default('sedang proses');

            $table->foreignId('supplier_id')->constrained(table: 'supplier')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
