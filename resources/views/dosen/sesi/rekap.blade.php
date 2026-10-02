<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Rekap Kehadiran Mahasiswa') }}
            </h2>
            <a href="{{ route('dosen.jadwal.index') }}"
                class="text-sm bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded transition">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Info Sesi -->
            <div class="bg-white p-6 rounded-lg shadow-sm mb-6 border-l-4 border-indigo-500">
                <h3 class="text-lg font-bold text-gray-800">{{ $sesi->jadwalKelas->mataKuliah->nama_mk }}
                    ({{ $sesi->jadwalKelas->nama_kelas }})</h3>
                <p class="text-sm text-gray-600 mt-1">
                    Tanggal: {{ \Carbon\Carbon::parse($sesi->tanggal)->translatedFormat('l, d F Y') }} <br>
                    Status Sesi:
                    @if ($sesi->status === 'open')
                        <span class="text-green-600 font-bold">Terbuka (Sedang Berjalan)</span>
                    @else
                        <span class="text-red-600 font-bold">Ditutup</span>
                    @endif
                </p>
                <p class="text-sm text-gray-600 mt-2 font-semibold">Total Hadir: {{ $daftar_hadir->count() }} Mahasiswa
                </p>
            </div>

            <!-- Tabel Daftar Hadir -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="w-full whitespace-no-wrap border-collapse border border-gray-200">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200">
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Mahasiswa</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Waktu Scan</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($daftar_hadir as $index => $hadir)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                            {{ $hadir->mahasiswa->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $hadir->mahasiswa->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($hadir->waktu_hadir)->format('H:i:s') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Hadir
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="px-6 py-4 whitespace-nowrap text-center text-gray-500 italic">Belum
                                            ada mahasiswa yang melakukan absensi.</td>
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
