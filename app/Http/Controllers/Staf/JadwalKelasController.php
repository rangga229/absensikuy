<?php

namespace App\Http\Controllers\Staf;

use App\Http\Controllers\Controller;
use App\Models\JadwalKelas;
use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Tarik data jadwal beserta data relasinya (dosen & matkul)
        $jadwal_kelas = JadwalKelas::with(['mataKuliah', 'dosen'])->get();
        return view('staf.jadwal_kelas.index', compact('jadwal_kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tarik semua data mata kuliah
        $mata_kuliah = MataKuliah::all();

        // Tarik data users yang role-nya hanya 'dosen'
        $dosen = User::where('role', 'dosen')->get();

        // Lempar kedua data tersebut ke view
        return view('staf.jadwal_kelas.create', compact('mata_kuliah', 'dosen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi input form
        $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'dosen_id' => 'required|exists:users,id',
            'nama_kelas' => 'required|string|max:50',
            'hari' => 'required|string',
            'lokasi' => 'required|string|max:100',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // 2. Simpan ke database
        JadwalKelas::create($request->all());

        // 3. Kembalikan ke halaman index dengan pesan sukses
        return redirect()->route('staf.jadwal-kelas.index')
            ->with('success', 'Jadwal kelas baru berhasil ditambahkan!');
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
        // Cari jadwal yang mau diedit
        $jadwal_kelas = JadwalKelas::findOrFail($id);

        // Tarik kembali data untuk pilihan dropdown
        $mata_kuliah = MataKuliah::all();
        $dosen = User::where('role', 'dosen')->get();

        return view('staf.jadwal_kelas.edit', compact('jadwal_kelas', 'mata_kuliah', 'dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jadwal_kelas = JadwalKelas::findOrFail($id);

        $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'dosen_id' => 'required|exists:users,id',
            'nama_kelas' => 'required|string|max:50',
            'hari' => 'required|string',
            'lokasi' => 'required|string|max:100',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $jadwal_kelas->update($request->all());

        return redirect()->route('staf.jadwal-kelas.index')
            ->with('success', 'Data jadwal kelas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal_kelas = JadwalKelas::findOrFail($id);
        $jadwal_kelas->delete();

        return redirect()->route('staf.jadwal-kelas.index')
            ->with('success', 'Jadwal kelas berhasil dihapus!');
    }
}
