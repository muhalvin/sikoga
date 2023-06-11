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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('surat_ket');
            $table->enum('verifikasi', ['1','2','3','4'])->nullable();
            $table->integer('id_kos')->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->enum('status_bayar', ['1','2','3'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};