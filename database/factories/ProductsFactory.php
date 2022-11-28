<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductsFactory extends Factory
{

/**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    //  protected $model = Products::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->sentence(), 
            'price' => $this->faker->unique()->numberBetween($min = 10, $max = 100),
            'description' => $this->faker->paragraph(),
        ];
    }
}
