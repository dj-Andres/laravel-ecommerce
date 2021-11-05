<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $images = [
            '/image/user1-128x128.jpg',
            '/image/user3-128x128.jpg',
            '/image/user4-128x128.jpg',
            '/image/user5-128x128.jpg',
            '/image/user6-128x128.jpg',
            '/image/user7-128x128.jpg',
            '/image/user8-128x128.jpg',
        ];

        return [
            'url' => $this->faker->randomElement($images)
        ];
    }
}
