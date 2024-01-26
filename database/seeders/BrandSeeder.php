<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::insert([
            ["brand_name"=> "Wi", "url" => "wiurl.com", "meta_title"=> "Wi brand"],
            ["brand_name"=> "AA", "url" => "aaurl.com", "meta_title"=> "AA brand"],
            ["brand_name"=> "GG", "url" => "ggurl.com", "meta_title"=> "GG brand"],
        ]);
    }
}
