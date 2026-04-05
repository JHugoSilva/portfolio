<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): void
    {
        Media::truncate();

        Media::factory()->create([
            'link' => 'https://github.com/seu-user',
            'icon' => 'ri-github-fill',
        ]);

        Media::factory()->create([
            'link' => 'https://linkedin.com/in/seu-user',
            'icon' => 'ri-linkedin-fill',
        ]);

        Media::factory()->create([
            'link' => 'https://instagram.com/seu-user',
            'icon' => 'ri-instagram-line',
        ]);
    }
}
