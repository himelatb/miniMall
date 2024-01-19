<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productRecords = [
            ['product_name'=>'Slim fit shirt','category_id'=>'9','product_code'=>'ST11','product_color'=>'green','color_family'=>'Green','product_price'=>'100','final_price'=>'100','description'=> 'Content is coming soon', 'keywords'=> 'about-us','material'=>'Cottom','size'=>'medium','height'=>15,'width'=> 12,'fit'=>'slim', 'meta_title'=>'About Us', 'meta_description'=>'About Us Content','meta_keywords'=>'about us, about','status'=>1],
            ['product_name'=>'lose fit shirt','category_id'=>'3','product_code'=>'LT11','product_color'=>'green','color_family'=>'Green','product_price'=>'100','final_price'=>'100','description'=> 'Content is coming soon', 'keywords'=> 'about-us','material'=>'Cottom','size'=>'medium','height'=>15,'width'=> 12,'fit'=>'slim', 'meta_title'=>'About Us', 'meta_description'=>'About Us Content','meta_keywords'=>'about us, about','status'=>2],
    
            ];
            Product::insert($productRecords);
    }
}
