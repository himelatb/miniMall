<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductAttribute::insert([
            ['product_id' => 1, 'size' => 'S', 'sku' => 'TPS','price' => 200, 'stock' => 100, 'category_id' => 1, 'color' => 'Red', 'color_code' => '#D22B2B'],
            ['product_id' => 1, 'size' => 'M', 'sku' => 'TPM','price' => 100, 'stock' => 150, 'category_id' => 6, 'color' => 'Red', 'color_code' => '#D22B2B'],
            ['product_id' => 1, 'size' => 'L', 'sku' => 'TPL','price' => 300, 'stock' => 600, 'category_id' => 7, 'color' => 'Red', 'color_code' => '#D22B2B'],
            ['product_id' => 2, 'size' => 'S', 'sku' => 'ILS','price' => 500, 'stock' => 70, 'category_id' => 2, 'color' => 'Red', 'color_code' => '#D22B2B'],
            ['product_id' => 2, 'size' => 'M', 'sku' => 'ILM','price' => 250, 'stock' => 10, 'category_id' => 1, 'color' => 'Red', 'color_code' => '#D22B2B'],
        ]);
    }
}
