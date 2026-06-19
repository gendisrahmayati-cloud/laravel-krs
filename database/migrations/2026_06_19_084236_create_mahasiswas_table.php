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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 20)->unique();
            $table->string('nama', 100);

            $table->foreignId('prodi_id')->nullable()->constrained('prodis')->onDelete('cascade');

            $table->string('status', 20)->default('Aktif');
            $table->text('alamat')->nullable();
            $table->string('foto')->nullable(); // Menampung path foto (Sesuai Percobaan 3)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
