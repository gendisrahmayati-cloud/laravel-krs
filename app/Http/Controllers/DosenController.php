<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Menampilkan daftar data master dosen.
     */
    public function index()
    {
        // Mengambil seluruh data dosen dari database krs_db lewat model Eloquent
        $dataDosen = Dosen::all(); 
        
        // Mengirimkan data tersebut ke file tampilan (view) dosen.blade.php
        return view('dosen', compact('dataDosen'));
    }

    /**
     * Menampilkan formulir untuk menambah dosen baru (Akses Admin).
     */
    public function create()
    {
        return view('tambah_dosen');
    }

    /**
     * Menyimpan data dosen baru ke database (Akses Admin).
     */
    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|unique:dosens,nidn|max:20',
            'nama_dosen' => 'required|string|max:255',
        ]);

        Dosen::create([
            'nidn' => $request->nidn,
            'nama_dosen' => $request->nama_dosen,
        ]);

        return redirect('/dosen')->with('success', 'Data Dosen PA berhasil ditambahkan!');
    }

    /**
     * Menampilkan formulir edit data dosen (Akses Admin).
     */
    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('edit_dosen', compact('dosen'));
    }

    /**
     * Memperbarui data dosen di database (Akses Admin).
     */
    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);

        $request->validate([
            'nidn' => 'required|max:20|unique:dosens,nidn,' . $dosen->id,
            'nama_dosen' => 'required|string|max:255',
        ]);

        $dosen->update([
            'nidn' => $request->nidn,
            'nama_dosen' => $request->nama_dosen,
        ]);

        return redirect('/dosen')->with('success', 'Data Dosen PA berhasil diperbarui!');
    }

    /**
     * Menghapus data dosen dari database (Akses Admin).
     */
    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();

        return redirect('/dosen')->with('success', 'Data Dosen PA berhasil dihapus!');
    }
}