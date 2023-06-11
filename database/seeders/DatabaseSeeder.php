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
                'username'      => 'muhalvin',
                'nama'          => 'Muhammad Alvin',
                'jk'            => 'L',
                'tgl_lahir'     => '2000-12-05',
                'alamat'        => 'Jombang',
                'no_hp'         => '081358963502',
                'kota_asal'     => 'Jombang',
                'role'          => 'Anak Kos',
                'password'      => Hash::make('muhalvin'),
                'created_at'    => now(),
            ],
        ];

        foreach ($userData as $key => $value) {
            User::create($value);
        }
    }
}