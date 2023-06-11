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
            $table->string('user_id');
            $table->string('surat_ket');
            $table->enum('acc_pengurus', ['1','2','3'])->nullable();
            $table->enum('acc_pemilik', ['1','2','3'])->nullable();
            $table->integer('id_kos')->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->enum('acc_bayar_pengurus', ['1','2','3'])->nullable();
            $table->enum('acc_bayar_pemilik', ['1','2','3'])->nullable();
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