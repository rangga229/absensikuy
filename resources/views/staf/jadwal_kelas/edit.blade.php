<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Jadwal Kelas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('staf.jadwal-kelas.update', $jadwal_kelas->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Dropdown Mata Kuliah -->
                        <div class="mb-4">
                            <x-input-label for="mata_kuliah_id" value="Mata Kuliah" />
                            <select id="mata_kuliah_id" name="mata_kuliah_id"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                <option value="" disabled>-- Pilih Mata Kuliah --</option>
                                @foreach ($mata_kuliah as $mk)
                                    <option value="{{ $mk->id }}"
                                        {{ old('mata_kuliah_id', $jadwal_kelas->mata_kuliah_id) == $mk->id ? 'selected' : '' }}>
                                        {{ $mk->kode_mk }} - {{ $mk->nama_mk }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('mata_kuliah_id')" />
                        </div>

                        <!-- Dropdown Dosen -->
                        <div class="mb-4">
                            <x-input-label for="dosen_id" value="Dosen Pengajar" />
                            <select id="dosen_id" name="dosen_id"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                <option value="" disabled>-- Pilih Dosen --</option>
                                @foreach ($dosen as $d)
                                    <option value="{{ $d->id }}"
                                        {{ old('dosen_id', $jadwal_kelas->dosen_id) == $d->id ? 'selected' : '' }}>
                                        {{ $d->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('dosen_id')" />
                        </div>

                        <!-- Nama Kelas -->
                        <div class="mb-4">
                            <x-input-label for="nama_kelas" value="Nama Kelas" />
                            <x-text-input id="nama_kelas" name="nama_kelas" type="text" class="mt-1 block w-full"
                                :value="old('nama_kelas', $jadwal_kelas->nama_kelas)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('nama_kelas')" />
                        </div>

                        <!-- Hari -->
                        <div class="mb-4">
                            <x-input-label for="hari" value="Hari" />
                            <select id="hari" name="hari"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                <option value="" disabled>-- Pilih Hari --</option>
                                @php $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']; @endphp
                                @foreach ($hari as $h)
                                    <option value="{{ $h }}"
                                        {{ old('hari', $jadwal_kelas->hari) == $h ? 'selected' : '' }}>
                                        {{ $h }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('hari')" />
                        </div>

                        <!-- Jam Mulai & Jam Selesai -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="jam_mulai" value="Jam Mulai" />
                                <!-- Mengambil 5 karakter awal (HH:mm) agar format time-nya sesuai -->
                                <x-text-input id="jam_mulai" name="jam_mulai" type="time" class="mt-1 block w-full"
                                    :value="old('jam_mulai', substr($jadwal_kelas->jam_mulai, 0, 5))" required />
                                <x-input-error class="mt-2" :messages="$errors->get('jam_mulai')" />
                            </div>
                            <div>
                                <x-input-label for="jam_selesai" value="Jam Selesai" />
                                <x-text-input id="jam_selesai" name="jam_selesai" type="time"
                                    class="mt-1 block w-full" :value="old('jam_selesai', substr($jadwal_kelas->jam_selesai, 0, 5))" required />
                                <x-input-error class="mt-2" :messages="$errors->get('jam_selesai')" />
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex items-center gap-4 mt-6">
                            <x-primary-button>Update Jadwal</x-primary-button>
                            <a href="{{ route('staf.jadwal-kelas.index') }}"
                                class="text-gray-600 hover:text-gray-900">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
