<?php

namespace Database\Factories;

use App\Models\odel;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<odel=Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product_name = $this->faker->unique()->words(6, TRUE);
        $slug = str()->slug($product_name);

        $categoryIds = Category::pluck('id')->toArray();
        $product_name = $this->faker->unique()->words(6, TRUE);
        $slug = str()->slug($product_name);

        return [
            'name' => $product_name,
            'slug' => $slug,
            'short_description'=>$this->faker->realText(200),
            'description'=>$this->faker->realText(500),
            'regular_price'=>$this->faker->numberBetween(10,500),
            'SKU'=>'PRD'. $this->faker->unique()->numberBetween(100,500),
            'stock_status'=>'in_stock',
            'quantity'=>$this->faker->numberBetween(10, 50),
            'image'=>$this->faker->imageUrl(),
            'category_id' => $categoryIds[array_rand($categoryIds)]
        ];
    }
}
