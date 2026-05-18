@extends('layouts.app')

@section('content')

<h2>Tambah KRS</h2>

<form action="/krs" method="POST">
    @csrf

    <input type="text" name="nama_mahasiswa" placeholder="Nama">
    <br><br>

    <input type="text" name="nim" placeholder="NIM">
    <br><br>

    <input type="number" name="semester" placeholder="Semester">
    <br><br>

    <textarea name="daftar_mata_kuliah"></textarea>
    <br><br>

    <input type="number" name="total_sks" placeholder="SKS">
    <br><br>

    <button type="submit">Simpan</button>

</form>

@endsection