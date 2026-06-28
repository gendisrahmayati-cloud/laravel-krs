<x-app-layout>

<x-slot name="header">
<h2 class="text-xl font-semibold">
Edit Mata Kuliah
</h2>
</x-slot>

<div class="py-10">

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

<form
action="/mata-kuliah/{{ $matkul->id }}"
method="POST">

@csrf
@method('PUT')

<label>Kode MK</label>

<input
type="text"
name="kode_mk"
value="{{ $matkul->kode_mk }}"
class="w-full border rounded mb-3">

<label>Nama Mata Kuliah</label>

<input
type="text"
name="nama_mk"
value="{{ $matkul->nama_mk }}"
class="w-full border rounded mb-3">

<label>SKS</label>

<input
type="number"
name="sks"
value="{{ $matkul->sks }}"
class="w-full border rounded mb-3">

<label>Semester</label>

<input
type="number"
name="semester"
value="{{ $matkul->semester }}"
class="w-full border rounded mb-3">

<button
class="bg-green-600 text-white px-4 py-2 rounded">

Update

</button>

</form>

</div>

</div>

</x-app-layout>