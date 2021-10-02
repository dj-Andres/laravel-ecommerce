<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->name(20);

        $arrayIcons = ['icon-fruits', 'icon-broccoli-1', 'icon-beef', 'icon-fish', 'icon-fast-food', 'icon-honey', 'icon-grape', 'icon-onions', 'icon-avocado'];

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'icon' => $this->faker->randomElement($arrayIcons),
            'description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
        ];
    }
}
