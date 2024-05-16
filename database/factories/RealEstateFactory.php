<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RealEstate>
 */
class RealEstateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $lang = 47.0024192;
        $long = 28.819456;

        $categories = ['sales', 'rent'];

        return [
            'address' => $this->faker->address,
            'description' => $this->faker->realText(),
            'cover' => $this->faker->image,
            'category' => $categories[array_rand($categories)],
            'phone_number' => $this->faker->phoneNumber,
            'price' => number_format($this->faker->numberBetween(40, 70), 2),
            'location' => $this->faker->city(),
            'lat' => $this->faker->latitude($min = ($lang - (rand(0,10000) / 1000)), $max = ($lang + (rand(0,10000) / 1000))),
            'lng' => $this->faker->longitude($min = ($long - (rand(0,10000) / 1000)), $max = ($long + (rand(0,10000) / 1000))),
            'created_at' => now()->addMinutes(),
            'updated_at' => now()->addMinutes(),
        ];
    }
}
