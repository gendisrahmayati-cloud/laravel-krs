<?php

namespace App\Http\Controllers;

// Pastikan kedua model ini di-import agar tidak error Class Not Found
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan daftar mahasiswa (Percobaan 2 - Eager Loading)
     */
    public function index()
    {
        // Menggunakan dengan('prodi') agar kueri database optimal (mencegah N+1 Problem)
        $mahasiswa = Mahasiswa::with('prodi')->get(); 
        return view('mahasiswa', ['dataMahasiswa' => $mahasiswa]);
    }

    /**
     * Menampilkan form tambah mahasiswa (Percobaan 2 - Dropdown Dinamis)
     */
    public function create()
    {
        // Mengambil semua data prodi dari database untuk dikirim ke select option
        $prodis = Prodi::all(); 
        return view('tambah_mahasiswa', compact('prodis'));
    }

    /**
     * Memproses data baru & upload gambar (Percobaan 4)
     */
    public function store(Request $request)
    {
        // 1. Validasi Input Data beserta batasan file gambar (Maksimal 2MB)
        $validatedData = $request->validate([ 
            'nim' => 'required|numeric|unique:mahasiswas,nim', 
            'nama' => 'required|min:3|max:100', 
            'prodi_id' => 'required', 
            'status' => 'required',
            'alamat' => 'nullable',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        // 2. Proses Upload Gambar ke Local Storage Laragon jika file dipilih
        if ($request->hasFile('foto')) { 
            // Menyimpan file di storage/app/public/foto_mahasiswa
            $validatedData['foto'] = $request->file('foto')->store('foto_mahasiswa', 'public');
        } 

        // 3. Masukkan data yang lolos validasi ke dalam database
        Mahasiswa::create($validatedData);

        return redirect('/mahasiswa')->with('success', 'Data Mahasiswa berhasil ditambahkan!');
    }
}