@extends('layouts.app')

@section('content')

<h2>Detail KRS</h2>

<p>
    Nama Mahasiswa :
    {{ $krs->nama_mahasiswa }}
</p>

<p>
    NIM :
    {{ $krs->nim }}
</p>

<p>
    Semester :
    {{ $krs->semester }}
</p>

<p>
    Mata Kuliah :
    {{ $krs->daftar_mata_kuliah }}
</p>

<p>
    Total SKS :
    {{ $krs->total_sks }}
</p>

<p>
    Status :
    {{ $krs->status_persetujuan }}
</p>

<a href="/krs">
    Kembali
</a>

@endsection