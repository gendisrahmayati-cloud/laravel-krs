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

            $table->foreignId('mahasiswa_id')->constrained()->onDelete('cascade');

            $table->string('semester');

            $table->string('tahun_ajaran');

            $table->integer('total_sks')->default(0);

            $table->string('bukti_ukt');

            $table->enum('status',[
                'Menunggu',
                'Disetujui',
                'Ditolak'
            ])->default('Menunggu');

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
