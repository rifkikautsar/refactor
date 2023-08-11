<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Admin',
            'email' => 'admin@skinpals.co.id',
            'jenisKelamin' => 'L',
            'tanggalLahir' => '2000-09-15',
            'password' => Hash::make("SkinPals2023!"),
            'aktif' => 1,
            'status' => 1
        ]);
    }
}
