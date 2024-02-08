<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banner::insert([
        ['title' => 'top banner', 'type' => 'Slider', 'text' => 'top banner', 'sort' => 1],
        ['title' => 'next banner', 'type' => 'Slider', 'text' => 'next banner', 'sort' => 2],
        ]);
    }
}
