<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(1),
            'price' => $this->faker->randomFloat(2, 3, 100),
            'stock' => $this->faker->numberBetween(1,10),
            'status' => $this->faker->randomElement(['available', 'unavailable']),
        ];
    }
}
