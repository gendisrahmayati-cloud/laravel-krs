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
        Schema::table('mahasiswas', function (Blueprint $table) {
            if (Schema::hasColumn('mahasiswas', 'program_studi')) {
                $table->dropColumn('program_studi');
            }
            $table->foreignId('prodi_id')->nullable()->constrained('prodis')->onDelete('cascade')->after('nama');
        });
    }


    public function down(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->dropForeign(['prodi_id']);
            $table->dropColumn('prodi_id');
        });
    }
};
