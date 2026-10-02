<x-app-layout>
    <div class="py-8 bg-gray-100 min-h-screen flex flex-col justify-center items-center">

        <!-- Header Kelas -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">
                {{ $sesi->jadwalKelas->mataKuliah->nama_mk }}
            </h1>
            <p class="text-xl text-gray-600 font-medium">
                Kelas: {{ $sesi->jadwalKelas->nama_kelas }} | Lokasi: {{ $sesi->jadwalKelas->lokasi }}
            </p>
            <p class="text-md text-gray-500 mt-2">
                Dosen: {{ Auth::user()->name }} | Tanggal:
                {{ \Carbon\Carbon::parse($sesi->tanggal)->translatedFormat('l, d F Y') }}
            </p>
        </div>

        <!-- Card QR Code -->
        <div class="bg-white p-10 rounded-2xl shadow-2xl border-4 border-indigo-100 flex flex-col items-center">

            <h2 class="text-2xl font-bold text-indigo-700 mb-6 uppercase tracking-widest">
                Scan Untuk Hadir
            </h2>

            <!-- Gambar QR Code menggunakan API External -->
            <div class="bg-white p-4 border-2 border-dashed border-gray-300 rounded-xl mb-6">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=400x400&data={{ $sesi->qr_token }}"
                    alt="QR Code Absensi"
                    class="w-72 h-72 object-contain hover:scale-105 transition-transform duration-300">
            </div>

            <p class="text-gray-500 text-sm mb-8 text-center max-w-xs">
                Arahkan kamera HP Anda ke QR Code di atas. Jaga jarak dan pastikan pencahayaan cukup.
            </p>

            <!-- Tombol Tutup Sesi -->
            <form action="{{ route('dosen.sesi.update', $sesi->id) }}" method="POST" class="w-full"
                onsubmit="return confirm('Yakin ingin menutup sesi absensi? Mahasiswa tidak akan bisa absen lagi setelah ini.');">
                @csrf
                @method('PUT')
                <button type="submit"
                    class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Tutup Sesi Absensi
                </button>
            </form>

        </div>
    </div>
</x-app-layout>
