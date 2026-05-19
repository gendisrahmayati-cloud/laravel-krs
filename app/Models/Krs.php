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
        'status_persetujuan'
    ];
}
