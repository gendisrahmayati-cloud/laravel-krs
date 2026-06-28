<x-app-layout>

<x-slot name="header">
<h2 class="text-xl font-semibold">
Tambah Mata Kuliah
</h2>
</x-slot>

<div class="py-10">

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

<form action="/mata-kuliah" method="POST">

@csrf

<label>Kode MK</label>

<input
type="text"
name="kode_mk"
class="w-full border rounded mb-3">

<label>Nama Mata Kuliah</label>

<input
type="text"
name="nama_mk"
class="w-full border rounded mb-3">

<label>SKS</label>

<input
type="number"
name="sks"
class="w-full border rounded mb-3">

<label>Semester</label>

<input
type="number"
name="semester"
class="w-full border rounded mb-3">

<button
class="bg-blue-600 text-white px-4 py-2 rounded">

Simpan

</button>

</form>

</div>

</div>

</x-app-layout>