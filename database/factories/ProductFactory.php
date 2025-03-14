<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'name' =>$this->faker->word(),
            'description' => $this->faker->sentence(),
            'category' => $this->faker->randomElement(['sieraden', 'Keramiek', 'Textiel', 'kunst']),
            'material' => $this->faker->randomElement(['zilver', 'goud', 'brons']),
            'production_time' => rand(3, 10),
            'complexity' => $this->faker->randomElement(['Eenvoudig', 'Gemiddeld', 'Complex']),
            'durability' => $this->faker->randomElement(['Kortdurend', 'Gemiddeld', 'Langdurig']),
            'unique_features' => $this->faker->sentence(3),
            'price' => $this->faker->randomFloat(2, 50, 150),
        ];
    }
}
