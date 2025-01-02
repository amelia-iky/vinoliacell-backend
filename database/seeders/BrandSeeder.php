<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Apple'],
            ['name' => 'Asus'],
            ['name' => 'Google'],
            ['name' => 'Huawei'],
            ['name' => 'Nokia'],
            ['name' => 'Oppo'],
            ['name' => 'Realme'],
            ['name' => 'Samsung'],
            ['name' => 'Vivo'],
            ['name' => 'Xiaomi'],
        ];

        foreach ($data as $brand) {
            Brand::create($brand);
        }
    }
}
