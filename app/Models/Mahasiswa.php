<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara spesifik
    protected $table = 'mahasiswas';

    // Mendaftarkan kolom yang boleh diisi (Mass Assignment) sesuai kebutuhan Modul 9
    protected $fillable = ['nim', 'nama', 'prodi_id', 'status', 'alamat', 'foto'];

    /**
     * Relasi Kebalikan (Belongs To)
     * Menandakan bahwa setiap mahasiswa berafiliasi ke satu Program Studi
     */
    public function prodi() 
    { 
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}