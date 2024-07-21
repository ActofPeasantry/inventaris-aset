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
        Schema::create('aset_rusak', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_aset_rusak');
            $table->string('keterangan');
            $table->enum('status_pengesahan', ['Diajukan', 'Disetujui', 'Ditolak', 'Revisi', 'Telah Direvisi'])
                ->default('Diajukan');

            $table->foreignId('aset_id')->constrained(table: 'aset')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained(table: 'users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset_rusak');
    }
};
