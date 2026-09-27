<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Staf Akademik
        User::create([
            'name' => 'Admin Staf',
            'email' => 'staf@absensikuy.com',
            'password' => Hash::make('password123'),
            'role' => 'staf',
            'nomor_induk' => 'STF-001',
        ]);

        // 2. Akun Dosen
        User::create([
            'name' => 'Bapak Dosen',
            'email' => 'dosen@absensikuy.com',
            'password' => Hash::make('password123'),
            'role' => 'dosen',
            'nomor_induk' => 'DSN-001',
        ]);

        // 3. Akun Mahasiswa Tambahan (Opsional)
        User::create([
            'name' => 'Udin Mahasiswa',
            'email' => 'mahasiswa@absensikuy.com',
            'password' => Hash::make('password123'),
            'role' => 'mahasiswa',
            'nomor_induk' => 'MHS-001',
        ]);
    }
}
