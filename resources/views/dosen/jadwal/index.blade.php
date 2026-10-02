<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jadwal Mengajar Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-indigo-600">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">🗓️ Daftar Kelas yang Anda Ajar</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full whitespace-no-wrap border-collapse border border-gray-200">
                            <thead>
                                <tr class="bg-indigo-50 border-b border-gray-200">
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Mata Kuliah</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kelas & Lokasi</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Waktu</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($jadwal_mengajar as $jadwal)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="font-bold text-gray-700">{{ $jadwal->mataKuliah->kode_mk }}</span><br>
                                            <span
                                                class="text-sm text-gray-500">{{ $jadwal->mataKuliah->nama_mk }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="font-semibold">{{ $jadwal->nama_kelas }}</span><br>
                                            <span class="text-sm text-gray-500">{{ $jadwal->lokasi }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="font-semibold text-gray-700">{{ $jadwal->hari }}</span><br>
                                            <span class="text-sm text-gray-500">{{ substr($jadwal->jam_mulai, 0, 5) }} -
                                                {{ substr($jadwal->jam_selesai, 0, 5) }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <!-- Tombol Buka Absensi (Persiapan) -->
                                            <form action="{{ route('dosen.sesi.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="jadwal_kelas_id"
                                                    value="{{ $jadwal->id }}">
                                                <button type="submit"
                                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    📸 Buka Absensi
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4"
                                            class="px-6 py-4 whitespace-nowrap text-center text-gray-500 italic">Anda
                                            tidak memiliki jadwal mengajar saat ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- BAGIAN 2: RIWAYAT SESI ABSENSI -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-green-500 mt-8">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-bold text-gray-800 mb-4">📋 Riwayat Sesi & Rekap Absensi</h3>
            <div class="overflow-x-auto">
                <table class="w-full whitespace-no-wrap border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-green-50 border-b border-gray-200">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Mata Kuliah & Kelas</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($riwayat_sesi as $sesi)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                    {{ \Carbon\Carbon::parse($sesi->tanggal)->translatedFormat('l, d F Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="font-bold text-gray-700">{{ $sesi->jadwalKelas->mataKuliah->nama_mk }}</span><br>
                                    <span class="text-xs text-gray-500">Kelas:
                                        {{ $sesi->jadwalKelas->nama_kelas }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if ($sesi->status === 'open')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Sedang Berjalan
                                        </span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Ditutup
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if ($sesi->status === 'open')
                                        <!-- Jika masih open, tombol arahkan kembali ke layar QR Code -->
                                        <a href="{{ route('dosen.sesi.show', $sesi->id) }}"
                                            class="inline-flex items-center px-3 py-1 bg-yellow-500 hover:bg-yellow-700 text-white font-bold rounded text-xs transition">
                                            Lihat Layar QR
                                        </a>
                                    @else
                                        <!-- Jika closed, tombol arahkan ke halaman Rekap -->
                                        <a href="{{ route('dosen.sesi.rekap', $sesi->id) }}"
                                            class="inline-flex items-center px-3 py-1 bg-green-500 hover:bg-green-700 text-white font-bold rounded text-xs transition">
                                            Lihat Rekap Hadir
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-gray-500 italic">
                                    Belum ada riwayat sesi absensi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
