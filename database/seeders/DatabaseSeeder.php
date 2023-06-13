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
                'username'      => 'pemilik',
                'nama'          => 'Pemilik Kos',
                'jk'            => 'L',
                'alamat'        => 'Surabaya',
                'no_hp'         => '08977662299',
                'kota_asal'     => 'Jombang',
                'role'          => 'Pemilik',
                'password'      => Hash::make('pemilik'),
                'created_at'    => now(),
            ],
        ];

        foreach ($userData as $key => $value) {
            User::create($value);
        }

        User::factory()
            ->count(50)
            ->create();
    }
}