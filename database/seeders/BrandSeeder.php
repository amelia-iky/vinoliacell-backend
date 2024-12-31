<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run()
    {
        Brand::create([
            'name' => 'Samsung',
        ]);

        Brand::create([
            'name' => 'Apple',
        ]);

        Brand::create([
            'name' => 'Xiaomi',
        ]);

        Brand::create([
            'name' => 'Oppo',
        ]);

        Brand::create([
            'name' => 'Vivo',
        ]);
    }
}
