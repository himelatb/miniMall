<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Color::insert( [
            ['color_name' => 'Red', 'color_code' => 'c1'],
            ['color_name' => 'Green', 'color_code' => 'c2'],
            ['color_name' => 'Blue', 'color_code' => 'c3'],
            ['color_name' => 'Yellow', 'color_code' => 'c3'],
            ['color_name' => 'Black', 'color_code' => 'c5'],
            ['color_name' => 'White', 'color_code' => 'c6'],
        ]);
    }
}
