<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use App\Models\MataKuliah;

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
        $mahasiswa = auth()->user()->mahasiswa;

        $mataKuliahs = MataKuliah::all();

        return view('krs.create', compact(
            'mahasiswa',
            'mataKuliahs'
        ));
    }

    // Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'semester' => 'required|numeric',
            'mata_kuliah' => 'required|array',
        ]);

        $mahasiswa = auth()->user()->mahasiswa;
        $mataKuliah = MataKuliah::whereIn('id', $request->mata_kuliah)->get();
        $daftarMK = $mataKuliah->pluck('nama_mata_kuliah')->implode(', ');
        $totalSKS = $mataKuliah->sum('sks');

        if (!$mahasiswa) {
            return back()->with('error', 'Data mahasiswa belum tersedia.');
        }

        $daftarMK = implode(', ', $request->mata_kuliah);

        Krs::create([
            'nama_mahasiswa' => $mahasiswa->nama,
            'nim' => $mahasiswa->nim,
            'semester' => $request->semester,
            'daftar_mata_kuliah' => $daftarMK,
            'total_sks' => $totalSKS,
            'dosen_id' => $mahasiswa->dosen_id,
            'bukti_ukt' => $mahasiswa->bukti_ukt,
            'status_persetujuan' => 'Pending',
        ]);

        return redirect('/krs')->with('success', 'Pengajuan KRS berhasil dikirim');
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
            'daftar_mata_kuliah' => $daftarMK,
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

    // ACC KRS
    public function acc($id)
    {
        $krs = Krs::findOrFail($id);

        $krs->status_persetujuan = 'Disetujui';
        $krs->save();

        return redirect('/krs')->with('success', 'KRS berhasil disetujui');
    }
}
