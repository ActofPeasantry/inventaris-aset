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
        Schema::create('aset', function (Blueprint $table) {
            $table->id();
            $table->string('nama_aset');
            $table->string('deskripsi_aset');
            $table->string('kode_aset')->unique();
            $table->integer('jumlah_aset')->default(0);


            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('kategori_aset_id')->constrained(table: 'kategori_aset', indexName: 'id')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset');
    }
};
