<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    // =================== INDEX ===================
    public function index()
    {
        $mahasiswa = Mahasiswa::with(['prodi', 'dosen'])->get();
        return view('mahasiswa', ['dataMahasiswa' => $mahasiswa]);
    }

    // =================== CREATE ===================
    public function create()
    {
        $prodis = Prodi::all();
        $dosens = Dosen::all();

        return view('tambah_mahasiswa', compact('prodis', 'dosens'));
    }

    // =================== STORE ===================
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nim' => 'required|numeric|unique:mahasiswas,nim',
            'nama' => 'required|min:3|max:100',
            'prodi_id' => 'required',
            'dosen_id' => 'required',
            'status' => 'required',
            'alamat' => 'nullable',

            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bukti_ukt' => 'required|mimes:pdf,jpeg,png,jpg|max:3072',
        ]);

        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('foto_mahasiswa', 'public');
        }

        if ($request->hasFile('bukti_ukt')) {
            $validatedData['bukti_ukt'] = $request->file('bukti_ukt')->store('bukti_ukt', 'public');
        }

        Mahasiswa::create($validatedData);

        return redirect('/mahasiswa')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    // =================== EDIT ===================
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $prodis = Prodi::all();
        $dosens = Dosen::all();

        return view('edit_mahasiswa', compact('mahasiswa', 'prodis', 'dosens'));
    }

    // =================== UPDATE ===================
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $validatedData = $request->validate([
            'nim' => 'required|numeric|unique:mahasiswas,nim,' . $id,
            'nama' => 'required|min:3|max:100',
            'prodi_id' => 'required',
            'dosen_id' => 'required',
            'status' => 'required',
            'alamat' => 'nullable',

            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bukti_ukt' => 'nullable|mimes:pdf,jpeg,png,jpg|max:3072',
        ]);

        // Upload foto baru
        if ($request->hasFile('foto')) {

            if ($mahasiswa->foto && Storage::disk('public')->exists($mahasiswa->foto)) {
                Storage::disk('public')->delete($mahasiswa->foto);
            }

            $validatedData['foto'] = $request->file('foto')->store('foto_mahasiswa', 'public');
        }

        // Upload bukti UKT baru
        if ($request->hasFile('bukti_ukt')) {

            if ($mahasiswa->bukti_ukt && Storage::disk('public')->exists($mahasiswa->bukti_ukt)) {
                Storage::disk('public')->delete($mahasiswa->bukti_ukt);
            }

            $validatedData['bukti_ukt'] = $request->file('bukti_ukt')->store('bukti_ukt', 'public');
        }

        $mahasiswa->update($validatedData);

        return redirect('/mahasiswa')
            ->with('success', 'Data mahasiswa berhasil diupdate.');
    }

    // =================== DELETE ===================
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Hapus foto
        if ($mahasiswa->foto && Storage::disk('public')->exists($mahasiswa->foto)) {
            Storage::disk('public')->delete($mahasiswa->foto);
        }

        // Hapus bukti UKT
        if ($mahasiswa->bukti_ukt && Storage::disk('public')->exists($mahasiswa->bukti_ukt)) {
            Storage::disk('public')->delete($mahasiswa->bukti_ukt);
        }

        $mahasiswa->delete();

        return redirect('/mahasiswa')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}