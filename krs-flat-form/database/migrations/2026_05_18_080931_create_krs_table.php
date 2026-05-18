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
    Schema::create('krs', function (Blueprint $table) {
        $table->id();
        $table->string('nama_mahasiswa');
        $table->string('nim');
        $table->integer('semester');
        $table->text('daftar_mata_kuliah');
        $table->integer('total_sks');
        $table->string('status_persetujuan')->default('Pending');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('krs');
    }
};
