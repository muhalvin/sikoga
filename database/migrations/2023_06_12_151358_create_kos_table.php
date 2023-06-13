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
        Schema::create('kos', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('nama_kos');
            $table->string('alamat');
            $table->string('biaya');
            $table->string('nomor');
            $table->string('nomor_alt')->nullable();
            $table->string('ukuran');
            $table->text('fasilitas')->nullable();
            $table->text('peraturan')->nullable();
            $table->enum('penghuni', ['L','P']);
            $table->string('f_depan')->nullable();
            $table->string('f_samping')->nullable();
            $table->string('f_kamar_1')->nullable();
            $table->string('f_kamar_2')->nullable();
            $table->string('f_kamar_3')->nullable();
            $table->enum('status', ['Penuh', 'Tersedia'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kos');
    }
};