<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Data Jadwal Kelas') }}
            </h2>
            <a href="{{ route('staf.jadwal-kelas.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm transition">
                + Tambah Jadwal Kelas
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Notifikasi Sukses -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full whitespace-no-wrap border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mata Kuliah</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Dosen Pengajar</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kelas</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jadwal</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($jadwal_kelas as $key => $jadwal)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $key + 1 }}</td>

                                    <!-- Memanggil relasi mataKuliah -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="font-bold text-gray-700">{{ $jadwal->mataKuliah->kode_mk }}</span><br>
                                        <span class="text-sm text-gray-500">{{ $jadwal->mataKuliah->nama_mk }}</span>
                                    </td>

                                    <!-- Memanggil relasi dosen -->
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->dosen->name }}</td>

                                    <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->nama_kelas }}</td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="font-semibold text-gray-700">{{ $jadwal->hari }}</span><br>
                                        <span class="text-sm text-gray-500">{{ substr($jadwal->jam_mulai, 0, 5) }} -
                                            {{ substr($jadwal->jam_selesai, 0, 5) }}</span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <a href="{{ route('staf.jadwal-kelas.edit', $jadwal->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                        <form action="{{ route('staf.jadwal-kelas.destroy', $jadwal->id) }}"
                                            method="POST" class="inline-block"
                                            onsubmit="return confirm('Yakin ingin menghapus jadwal ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="px-6 py-4 whitespace-nowrap text-center text-gray-500 italic">Belum ada
                                        data jadwal kelas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
