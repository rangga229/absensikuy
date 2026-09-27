<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Mata Kuliah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('staf.mata-kuliah.update', $mata_kuliah->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="kode_mk" value="Kode Mata Kuliah" />
                            <x-text-input id="kode_mk" name="kode_mk" type="text"
                                class="mt-1 block w-full bg-gray-100" :value="old('kode_mk', $mata_kuliah->kode_mk)" required readonly
                                title="Kode MK tidak boleh diubah" />
                            <x-input-error class="mt-2" :messages="$errors->get('kode_mk')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="nama_mk" value="Nama Mata Kuliah" />
                            <x-text-input id="nama_mk" name="nama_mk" type="text" class="mt-1 block w-full"
                                :value="old('nama_mk', $mata_kuliah->nama_mk)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('nama_mk')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="sks" value="Jumlah SKS" />
                            <x-text-input id="sks" name="sks" type="number" min="1" max="6"
                                class="mt-1 block w-full" :value="old('sks', $mata_kuliah->sks)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('sks')" />
                        </div>

                        <div class="flex items-center gap-4 mt-6">
                            <x-primary-button>Update Data</x-primary-button>
                            <a href="{{ route('staf.mata-kuliah.index') }}"
                                class="text-gray-600 hover:text-gray-900">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
