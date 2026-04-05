<?php

namespace Database\Factories;

use App\Models\About;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<About>
 */
class AboutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'home_image' => '/template/assets/img/home.jpg',
            'banner_image' => '/template/assets/img/banner.jpg',
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->city(),
            'description' => fake()->sentence(),
            'summary' => fake()->paragraph(),
            'tagline' => fake()->catchPhrase(),
            'cv' => '/files/cv.pdf',
        ];
    }
}
