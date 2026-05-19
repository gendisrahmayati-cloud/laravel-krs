<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $krs = Krs::all();

    return view('krs.index', compact('krs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('krs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'nama_mahasiswa' => 'required',
        'nim' => 'required',
        'semester' => 'required',
        'daftar_mata_kuliah' => 'required',
        'total_sks' => 'required'
    ]);

    Krs::create([
        'nama_mahasiswa' => $request->nama_mahasiswa,
        'nim' => $request->nim,
        'semester' => $request->semester,
        'daftar_mata_kuliah' => $request->daftar_mata_kuliah,
        'total_sks' => $request->total_sks,
        'status_persetujuan' => 'Pending'
    ]);

    return redirect('/krs');
    }

    /**
     * Display the specified resource.
     */
    public function show(Krs $krs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Krs $id)
    {
        $krs = Krs::findOrFail($id);

        return view('krs.edit', compact('krs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Krs $id)
    {
        $krs = Krs::findOrFail($id);

        $krs->update($request->all());

        return redirect('/krs');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Krs $id)
    {
        $krs = Krs::findOrFail($id);

        $krs->delete();

        return redirect('/krs');
    }
}
