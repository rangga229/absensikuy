<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Scan QR Code Kehadiran') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen bg-gray-100 flex flex-col items-center">
        <div class="w-full max-w-md px-4">

            <!-- Notifikasi Error jika token salah/kadaluarsa -->
            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative shadow-sm"
                    role="alert">
                    <span class="block sm:inline font-semibold">Gagal: {{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-200">
                <div class="text-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Arahkan Kamera ke Proyektor</h3>
                    <p class="text-sm text-gray-500 mt-1">Sistem akan memproses kehadiran Anda secara otomatis saat QR
                        Code terbaca.</p>
                </div>

                <!-- Kotak tempat kamera akan muncul -->
                <div class="overflow-hidden rounded-xl border-4 border-indigo-500 relative bg-gray-50">
                    <div id="reader" width="100%"></div>
                </div>

                <!-- Form tersembunyi untuk mengirim token -->
                <form id="scan-form" action="{{ route('mahasiswa.scan.store') }}" method="POST" class="hidden">
                    @csrf
                    <input type="hidden" name="qr_token" id="qr_token_input">
                </form>

                <div class="mt-6 text-center text-xs text-gray-400">
                    *Pastikan Anda telah memberikan izin akses kamera pada browser.
                </div>
            </div>
        </div>
    </div>

    <!-- Panggil Library HTML5-QRCode dari CDN -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <!-- Logika Javascript Kamera -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fungsi yang dijalankan saat QR Code berhasil terbaca
            function onScanSuccess(decodedText, decodedResult) {
                // 1. Hentikan kamera agar tidak scan berkali-kali
                html5QrcodeScanner.clear();

                // 2. Masukkan teks token dari QR ke dalam input form tersembunyi
                document.getElementById('qr_token_input').value = decodedText;

                // 3. Submit form secara otomatis ke Laravel
                document.getElementById('scan-form').submit();
            }

            // Fungsi jika kamera gagal membaca (opsional dibiarkan kosong agar tidak spam console)
            function onScanFailure(error) {
                // console.warn(`Code scan error = ${error}`);
            }

            // Konfigurasi Kamera (Gunakan kamera belakang, kotak scan 250px)
            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    },
                    supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
                },
                /* verbose= */
                false
            );

            // Render/Tampilkan kamera ke dalam div #reader
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        });
    </script>
</x-app-layout>
