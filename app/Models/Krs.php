<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    protected $table = 'krs';

    protected $fillable = [
        'nama_mahasiswa',
        'nim',
        'semester',
        'daftar_mata_kuliah',
        'total_sks',
        'dosen_id',
        'bukti_ukt',
        'status_persetujuan'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}