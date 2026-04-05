<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('media')->truncate();

        \DB::table('media')->insert([
            [
                'link' => 'https://github.com/seu-user',
                'icon' => 'ri-github-fill',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'link' => 'https://linkedin.com/in/seu-user',
                'icon' => 'ri-linkedin-fill',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'link' => 'https://instagram.com/seu-user',
                'icon' => 'ri-instagram-line',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'link' => 'https://facebook.com/seu-user',
                'icon' => 'ri-facebook-fill',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
