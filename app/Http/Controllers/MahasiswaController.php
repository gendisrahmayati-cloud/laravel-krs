<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Dosen;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // Percobaan 2 Langkah 4 & Percobaan 4 Langkah 3
    public function index()
    {
        $mahasiswa = Mahasiswa::with('prodi')->get(); 
        return view('mahasiswa', ['dataMahasiswa' => $mahasiswa]);
    }

    // Percobaan 2 Langkah 2
    public function create()
    {
        $prodis = Prodi::all();
        $dosens = Dosen::all();
        return view('tambah_mahasiswa', compact('prodis', 'dosens'));
    }

    // Percobaan 4 Langkah 2
    public function store(Request $request)
    {
        $validatedData = $request->validate([ 
            'nim' => 'required|numeric|unique:mahasiswas,nim', 
            'nama' => 'required|min:3|max:100', 
            'prodi_id' => 'required', 
            'dosen_id' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bukti_ukt' => 'required|mimes:pdf,jpeg,png,jpg|max:3072',
        ]);

        // Tambahan input manual jika form kamu membutuhkannya
        $validatedData['status'] = $request->status ?? 'Aktif';
        $validatedData['alamat'] = $request->alamat;

        // Proses Upload Gambar
        if ($request->hasFile('foto')) { 
            $validatedData['foto'] = $request->file('foto')->store('foto_mahasiswa', 'public');
        }

        if ($request->hasFile('bukti_ukt')) {
            $validatedData['bukti_ukt'] = $request->file('bukti_ukt')->store('bukti_ukt', 'public');
        }

        Mahasiswa::create($validatedData);
        return redirect('/mahasiswa')->with('success', 'Pengajuan KRS Mahasiswa berhasil ditambahkan!');
    }
}