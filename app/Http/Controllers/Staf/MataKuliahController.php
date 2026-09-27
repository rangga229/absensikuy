<?php

namespace App\Http\Controllers\Staf;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data mata kuliah dan melemparnya ke view
        $mata_kuliah = MataKuliah::all();
        return view('staf.mata_kuliah.index', compact('mata_kuliah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staf.mata_kuliah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi inputan form
        $request->validate([
            'kode_mk' => 'required|unique:mata_kuliah,kode_mk',
            'nama_mk' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
        ]);

        // 2. Simpan ke database
        MataKuliah::create($request->all());

        // 3. Kembalikan ke halaman index dengan pesan sukses
        return redirect()->route('staf.mata-kuliah.index')
            ->with('success', 'Mata kuliah baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Cari data berdasarkan ID, lalu lempar ke form edit
        $mata_kuliah = MataKuliah::findOrFail($id);
        return view('staf.mata_kuliah.edit', compact('mata_kuliah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mata_kuliah = MataKuliah::findOrFail($id);

        // Validasi: kode_mk boleh sama dengan miliknya sendiri saat ini
        $request->validate([
            'kode_mk' => 'required|unique:mata_kuliah,kode_mk,' . $mata_kuliah->id,
            'nama_mk' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
        ]);

        // Update data
        $mata_kuliah->update($request->all());

        return redirect()->route('staf.mata-kuliah.index')
            ->with('success', 'Data mata kuliah berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mataKuliah = MataKuliah::findOrFail($id);
        $mataKuliah->delete();

        return redirect()->route('staf.mata-kuliah.index')->with('success', 'Mata kuliah berhasil dihapus!');
    }
}
