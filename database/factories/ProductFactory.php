<?php

namespace Database\Factories;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_name'=> $this->faker->words(3, true),
            'category_id'=> $this->faker->numberBetween(0,12),
            'product_code'=> $this->faker->word(),
            'product_price'=>$this->faker->numberBetween(100,19999),
            'description'=> $this->faker->paragraph(),
        ];
    }
}
