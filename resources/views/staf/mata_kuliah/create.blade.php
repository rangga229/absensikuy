<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Mata Kuliah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('staf.mata-kuliah.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="kode_mk" value="Kode Mata Kuliah" />
                            <x-text-input id="kode_mk" name="kode_mk" type="text" class="mt-1 block w-full"
                                :value="old('kode_mk')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('kode_mk')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="nama_mk" value="Nama Mata Kuliah" />
                            <x-text-input id="nama_mk" name="nama_mk" type="text" class="mt-1 block w-full"
                                :value="old('nama_mk')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('nama_mk')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="sks" value="Jumlah SKS" />
                            <x-text-input id="sks" name="sks" type="number" min="1" max="6"
                                class="mt-1 block w-full" :value="old('sks')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('sks')" />
                        </div>

                        <div class="flex items-center gap-4 mt-6">
                            <x-primary-button>Simpan Data</x-primary-button>
                            <a href="{{ route('staf.mata-kuliah.index') }}"
                                class="text-gray-600 hover:text-gray-900">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
