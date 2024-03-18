<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(AdminsTableSeeder::class);
        $this->call(CmsPageTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductsImagesSeeder::class);
        $this->call(ProductAttributeSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(BannerSeeder::class);

    }
}
