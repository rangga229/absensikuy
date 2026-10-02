<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengisian Kartu Rencana Studi (KRS)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Notifikasi Pesan -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- BAGIAN 1: KRS SAYA -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8 border-l-4 border-indigo-500">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">📚 KRS Saya (Kelas yang Diambil)</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full whitespace-no-wrap border-collapse border border-gray-200">
                            <thead>
                                <tr class="bg-indigo-50 border-b border-gray-200">
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mata
                                        Kuliah</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dosen
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kelas &
                                        Lokasi</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu
                                    </th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($krs_saya as $krs)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <span
                                                class="font-bold text-gray-700">{{ $krs->jadwalKelas->mataKuliah->kode_mk }}</span><br>
                                            <span class="text-sm">{{ $krs->jadwalKelas->mataKuliah->nama_mk }}</span>
                                        </td>
                                        <td class="px-4 py-3">{{ $krs->jadwalKelas->dosen->name }}</td>
                                        <td class="px-4 py-3">
                                            <span class="font-semibold">{{ $krs->jadwalKelas->nama_kelas }}</span><br>
                                            <span class="text-sm text-gray-500">{{ $krs->jadwalKelas->lokasi }}</span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="font-semibold">{{ $krs->jadwalKelas->hari }}</span><br>
                                            <span
                                                class="text-xs text-gray-500">{{ substr($krs->jadwalKelas->jam_mulai, 0, 5) }}
                                                - {{ substr($krs->jadwalKelas->jam_selesai, 0, 5) }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <form action="{{ route('mahasiswa.krs.destroy', $krs->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin membatalkan kelas ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-xs transition">
                                                    Batalkan
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-6 text-center text-gray-500 italic">Anda belum
                                            mengambil kelas apapun. Silakan pilih di bawah.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- BAGIAN 2: JADWAL TERSEDIA -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-green-500">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">✨ Jadwal Kelas Tersedia</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full whitespace-no-wrap border-collapse border border-gray-200">
                            <thead>
                                <tr class="bg-green-50 border-b border-gray-200">
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mata
                                        Kuliah</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dosen
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kelas &
                                        Lokasi</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu
                                    </th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($jadwal_tersedia as $jadwal)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <span
                                                class="font-bold text-gray-700">{{ $jadwal->mataKuliah->kode_mk }}</span><br>
                                            <span class="text-sm">{{ $jadwal->mataKuliah->nama_mk }}</span>
                                        </td>
                                        <td class="px-4 py-3">{{ $jadwal->dosen->name }}</td>
                                        <td class="px-4 py-3">
                                            <span class="font-semibold">{{ $jadwal->nama_kelas }}</span><br>
                                            <span class="text-sm text-gray-500">{{ $jadwal->lokasi }}</span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="font-semibold">{{ $jadwal->hari }}</span><br>
                                            <span class="text-xs text-gray-500">{{ substr($jadwal->jam_mulai, 0, 5) }}
                                                - {{ substr($jadwal->jam_selesai, 0, 5) }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <form action="{{ route('mahasiswa.krs.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="jadwal_kelas_id"
                                                    value="{{ $jadwal->id }}">
                                                <button type="submit"
                                                    class="bg-indigo-600 hover:bg-indigo-800 text-white font-bold py-1 px-4 rounded text-xs transition">
                                                    Ambil Kelas
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-6 text-center text-gray-500 italic">Semua
                                            kelas sudah Anda ambil atau belum ada jadwal yang dibuat oleh Staf.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
