<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'userName' => 'Syahrul',
            'fullName' => 'Mochammad Syahrul Kurniawan',
            'address' => 'Jl. Raya Sudirman, Singaraja',
            'telp' => '083847847555',
            'email' => 'user1@email.com',
            'password' => Hash::make('user123'),
        ]);

        User::create([
            'userName' => 'Amelia',
            'fullName' => 'Amelia Rizky Yuniar',
            'address' => 'Jl. Raya Sudirman, Singaraja',
            'telp' => '0881026241853',
            'email' => 'user2@email.com',
            'password' => Hash::make('user123'),
        ]);
    }
}
