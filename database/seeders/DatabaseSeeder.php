<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(
            [
                AboutSeeder::class,
                MediaSeeder::class,
                ServiceSeeder::class,
                SkillSeeder::class,
                ProjectSeeder::class,
                TestimonialSeeder::class,
                UsersTableSeeder::class,
                ExperienceSeeder::class,
                EducationSeeder::class
            ]
        );
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
