<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    // Menampilkan semua data
    public function index()
    {
        $krs = Krs::all();

        return view('krs.index', compact('krs'));
    }

    // Form tambah data
    public function create()
    {
        return view('krs.create');
    }

    // Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'nama_mahasiswa' => 'required',
            'nim' => 'required',
            'semester' => 'required|numeric',
            'daftar_mata_kuliah' => 'required',
            'total_sks' => 'required|numeric'
        ], [
            'nama_mahasiswa.required' => 'Nama mahasiswa wajib diisi',
            'nim.required' => 'NIM wajib diisi',
            'semester.required' => 'Semester wajib diisi',
            'daftar_mata_kuliah.required' => 'Mata kuliah wajib diisi',
            'total_sks.required' => 'SKS wajib diisi'
        ]);

        Krs::create([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'nim' => $request->nim,
            'semester' => $request->semester,
            'daftar_mata_kuliah' => $request->daftar_mata_kuliah,
            'total_sks' => $request->total_sks,
            'status_persetujuan' => 'Pending'
        ]);

        return redirect('/krs')
            ->with('success', 'Data berhasil ditambahkan');
    }

    // Detail data
    public function show($id)
    {
        $krs = Krs::findOrFail($id);

        return view('krs.show', compact('krs'));
    }

    // Form edit
    public function edit($id)
    {
        $krs = Krs::findOrFail($id);

        return view('krs.edit', compact('krs'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mahasiswa' => 'required',
            'nim' => 'required',
            'semester' => 'required|numeric',
            'daftar_mata_kuliah' => 'required',
            'total_sks' => 'required|numeric'
        ]);

        $krs = Krs::findOrFail($id);

        $krs->update([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'nim' => $request->nim,
            'semester' => $request->semester,
            'daftar_mata_kuliah' => $request->daftar_mata_kuliah,
            'total_sks' => $request->total_sks
        ]);

        return redirect('/krs')
            ->with('success', 'Data berhasil diupdate');
    }

    // Hapus data
    public function destroy($id)
    {
        $krs = Krs::findOrFail($id);

        $krs->delete();

        return redirect('/krs')
            ->with('success', 'Data berhasil dihapus');
    }
}
