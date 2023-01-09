<?php

namespace Database\Factories;

use App\Models\odel;
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
    public function definition()
    {
        $product_name = $this->faker->unique()->words(6, TRUE);
        $slug = str()->slug($product_name);

        return [
            'name' => $product_name,
            'slug' => $slug,
            'short_description'=>$this->faker->text(200),
            'description'=>$this->faker->text(500),
            'regular_price'=>$this->faker->numberBetween(10,500),
            'SKU'=>'PRD'. $this->faker->unique()->numberBetween(100,500),
            'stock_status'=>'in_stock',
            'quantity'=>$this->faker->numberBetween(10, 50),
            'image'=>'product-'.$this->faker->numberBetween(1,16),
            'category_id'=>$this->faker->numberBetween(1,5),
        ];
    }
}
