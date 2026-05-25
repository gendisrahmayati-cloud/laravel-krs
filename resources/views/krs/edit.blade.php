@extends('layouts.app')

@section('content')

@if($errors->any())

<div style="
background:#f8d7da;
padding:15px;
margin-bottom:15px;
border-radius:5px">

    <ul>

        @foreach($errors->all() as $error)

        <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<style>
    .form-container {
        width: 500px;
        margin: auto;
        padding: 20px;
        border-radius: 10px;
        background-color: #f4f4f4;
        box-shadow: 0px 0px 10px gray;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
    }

    input,
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>

<div class="form-container">

    <h2>Edit KRS</h2>

    <form action="/krs/{{ $krs->id }}" method="POST">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama Mahasiswa</label>
            <input type="text"
                name="nama_mahasiswa"
                value="{{ $krs->nama_mahasiswa }}">
        </div>

        <div class="form-group">
            <label>NIM</label>
            <input type="text"
                name="nim"
                value="{{ $krs->nim }}">
        </div>

        <div class="form-group">
            <label>Semester</label>
            <input type="number"
                name="semester"
                value="{{ $krs->semester }}">
        </div>

        <div class="form-group">
            <label>Daftar Mata Kuliah</label>
            <textarea name="daftar_mata_kuliah">{{ $krs->daftar_mata_kuliah }}</textarea>
        </div>

        <div class="form-group">
            <label>Total SKS</label>
            <input type="number"
                name="total_sks"
                value="{{ $krs->total_sks }}">
        </div>

        <button type="submit">
            Update
        </button>

    </form>

</div>

@endsection