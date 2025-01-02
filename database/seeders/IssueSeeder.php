<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Issue;

class IssueSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Kerusakan Baterai'],
            ['name' => 'Kerusakan Kamera'],
            ['name' => 'Kerusakan Layar'],
            ['name' => 'Kerusakan Software'],
            ['name' => 'Kerusakan Tombol Fisik'],
            ['name' => 'Masalah Konektivitas'],
            ['name' => 'Masalah Pengisian Daya'],
            ['name' => 'Masalah Suara'],
        ];

        foreach ($data as $issues) {
            Issue::create($issues);
        }
    }
}
