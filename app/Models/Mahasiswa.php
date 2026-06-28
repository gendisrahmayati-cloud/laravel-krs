<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
    'nim',
    'nama',
    'prodi_id',
    'dosen_id',
    'status',
    'alamat',
    'foto',
    'bukti_ukt'
    ];

    public function prodi() 
    { 
        return $this->belongsTo(Prodi::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
}