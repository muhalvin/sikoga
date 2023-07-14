<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userData = [
            [
                'username'      => 'pengurus',
                'nama'          => 'Pengurus',
                'jk'            => 'L',
                'alamat'        => 'Jombang',
                'no_hp'         => '08510012345',
                'kota_asal'     => 'Jakarta',
                'role'          => 'Pengurus',
                'password'      => Hash::make('pengurus'),
                'created_at'    => now(),
            ],
            [
                'username'      => 'budi',
                'nama'          => 'Budi',
                'jk'            => 'L',
                'alamat'        => 'Jombang',
                'no_hp'         => '08511012345',
                'kota_asal'     => 'Jombang',
                'role'          => 'Pengurus',
                'password'      => Hash::make('budi'),
                'created_at'    => now(),
            ],
            [
                'username'      => 'andana',
                'nama'          => 'Andana',
                'jk'            => 'L',
                'alamat'        => 'Surabaya',
                'no_hp'         => '08977662299',
                'kota_asal'     => 'Jombang',
                'role'          => 'Pemilik',
                'password'      => Hash::make('andana'),
                'created_at'    => now(),
            ],
            [
                'username'      => 'andini',
                'nama'          => 'Andini',
                'jk'            => 'P',
                'alamat'        => 'Jombang',
                'no_hp'         => '08977898212',
                'kota_asal'     => 'Bandung',
                'role'          => 'Pemilik',
                'password'      => Hash::make('andini'),
                'created_at'    => now(),
            ],
            [
                'username'      => 'user',
                'nama'          => 'Pengguna',
                'jk'            => 'L',
                'alamat'        => 'Jombang',
                'no_hp'         => '08977812212',
                'kota_asal'     => 'Bandung',
                'role'          => 'Anak Kos',
                'password'      => Hash::make('user'),
                'created_at'    => now(),
            ]
        ];

        foreach ($userData as $key => $value) {
            User::create($value);
        }

        User::factory()
            ->count(10)
            ->create();
    }
}