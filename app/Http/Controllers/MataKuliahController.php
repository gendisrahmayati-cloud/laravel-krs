<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $matkuls = MataKuliah::all();

        return view('mata_kuliah', compact('matkuls'));
    }

    public function create()
    {
        return view('tambah_mata_kuliah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk'=>'required',
            'nama_mk'=>'required',
            'sks'=>'required|numeric',
            'semester'=>'required|numeric'
        ]);

        MataKuliah::create($request->all());

        return redirect('/mata-kuliah')
            ->with('success','Mata kuliah berhasil ditambahkan');
    }

    public function edit($id)
    {
        $matkul = MataKuliah::findOrFail($id);

        return view('edit_mata_kuliah', compact('matkul'));
    }

    public function update(Request $request,$id)
    {
        $matkul = MataKuliah::findOrFail($id);

        $request->validate([
            'kode_mk'=>'required',
            'nama_mk'=>'required',
            'sks'=>'required|numeric',
            'semester'=>'required|numeric'
        ]);

        $matkul->update($request->all());

        return redirect('/mata-kuliah')
            ->with('success','Data berhasil diupdate');
    }

    public function destroy($id)
    {
        MataKuliah::findOrFail($id)->delete();

        return redirect('/mata-kuliah')
            ->with('success','Data berhasil dihapus');
    }
}