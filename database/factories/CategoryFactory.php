<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category_name = $this->faker->unique()->words(2, TRUE);
        $slug = str()->slug($category_name);
        return [
            'name'=> $category_name,
            'slug'=> $slug,
            'image' => $this->faker->imageUrl(),
            'is_popular'=>random_int(0, 1),
        ];
    }
}
