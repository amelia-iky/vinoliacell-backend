<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Issue;

class IssueSeeder extends Seeder
{
    public function run()
    {
        Issue::create([
            'name' => 'Kerusakan Layar',
        ]);

        Issue::create([
            'name' => 'Kerusakan Baterai',
        ]);

        Issue::create([
            'name' => 'Masalah Pengisian Daya',
        ]);

        Issue::create([
            'name' => 'Kerusakan Kamera',
        ]);

        Issue::create([
            'name' => 'Masalah Suara',
        ]);

        Issue::create([
            'name' => 'Masalah Konektivitas',
        ]);

        Issue::create([
            'name' => 'Kerusakan Tombol Fisik',
        ]);

        Issue::create([
            'name' => 'Kerusakan Software',
        ]);
    }
}
