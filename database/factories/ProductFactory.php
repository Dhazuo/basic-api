<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'enterprise_id' => rand(1, 4),
            'category_id' => rand(1, 4),
            'name' => $this->faker->name,
            'description' => $this->faker->text(200),
            'price' => rand(1000, 2000),
            'stock' => rand(0, 16),
        ];
    }
}
