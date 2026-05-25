<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Krs extends Model
{
    use HasFactory;

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
