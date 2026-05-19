@extends('layouts.app')

@section('content')

<a href="/krs/create">Tambah Data</a>

<table border="1">

<tr>
    <th>Nama</th>
    <th>NIM</th>
    <th>Semester</th>
</tr>

@foreach($krs as $item)

<tr>
    <td>{{ $item->nama_mahasiswa }}</td>
    <td>{{ $item->nim }}</td>
    <td>{{ $item->semester }}</td>
</tr>

@endforeach

</table>

@endsection