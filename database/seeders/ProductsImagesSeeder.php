<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\products_images;

class ProductsImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        products_images::insert( [
            ['product_id' => '1', 'image' => 'a.jpg', 'image_sort' => 1],
            ['product_id' => '1', 'image' => 'a.jpg', 'image_sort' => 2],
            ['product_id' => '1', 'image' => 'a.jpg', 'image_sort' => 3],
        ]);
    }
}
