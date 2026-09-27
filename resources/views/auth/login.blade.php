<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Branding AbsensiKuy -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-extrabold text-indigo-600 tracking-tight">
            Absensi<span class="text-gray-800">Kuy</span>
        </h2>
        <p class="text-gray-500 text-sm mt-2">Sistem Absensi Kelas Berbasis QR Code</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4 flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button class="ms-3 w-full justify-center bg-indigo-600 hover:bg-indigo-700">
                {{ __('Masuk (Login)') }}
            </x-primary-button>
        </div>
    </form>

    <!-- KOTAK BANTUAN TESTING (Hanya tampil di localhost) -->
    @if(app()->environment('local'))
    <div class="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-lg text-sm text-blue-800 shadow-sm">
        <p class="font-bold mb-2 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Data Akun Testing (Password: password123)
        </p>
        <ul class="list-disc list-inside space-y-1 ml-1">
            <li class="cursor-pointer hover:text-blue-600 transition" onclick="document.getElementById('email').value='staf@absensikuy.com'; document.getElementById('password').value='password123';">Staf: staf@absensikuy.com</li>
            <li class="cursor-pointer hover:text-blue-600 transition" onclick="document.getElementById('email').value='dosen@absensikuy.com'; document.getElementById('password').value='password123';">Dosen: dosen@absensikuy.com</li>
            <li class="cursor-pointer hover:text-blue-600 transition" onclick="document.getElementById('email').value='mahasiswa@absensikuy.com'; document.getElementById('password').value='password123';">Mhs: mahasiswa@absensikuy.com</li>
        </ul>
        <p class="mt-2 text-xs italic text-blue-600">*Klik salah satu email di atas untuk mengisi form otomatis.</p>
    </div>
    @endif
</x-guest-layout>