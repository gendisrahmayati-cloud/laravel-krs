<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->foreignId('dosen_id')->after('prodi_id');
            $table->string('bukti_ukt')->nullable()->after('foto');
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->dropColumn(['dosen_id', 'bukti_ukt']);
        });
    }
};