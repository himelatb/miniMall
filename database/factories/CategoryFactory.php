<?php

namespace Database\Factories;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->word();
        $desc = $this->faker->paragraph();
        $title = $name .' title';

        return [
            'parent_id'=> $this->faker->numberBetween(0, 2),
            'category_name'=> $name,
            'category_discount'=> $this->faker->numberBetween(0, 40),
            'description'=> $desc,
            'url'=> $this->faker->url(),
            'meta_title'=> $title ,
            'meta_description'=> $desc,
            'meta_keywords'=> $name.','.$title,
            'status'=> $this->faker->numberBetween(0,1),
        ];
    }
}
