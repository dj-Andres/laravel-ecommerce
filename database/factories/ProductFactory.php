<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $name = $this->faker->unique()->word(20);
        return [
            'code' => $this->faker->ean8(),
            'name' => $name,
            'slug' => Str::slug($name),
            'sell_price' => $this->faker->randomNumber(2),
            'short_description' =>$this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'long_description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'status' => 'ACTIVE',
            'subcategory_id' => SubCategory::all()->random()->id,
            'provider_id' => Provider::all()->random()->id,
        ];
    }
}
