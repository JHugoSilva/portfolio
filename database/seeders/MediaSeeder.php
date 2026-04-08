<?php

namespace Database\Seeders;

use App\Models\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('media')->truncate();

        DB::table('media')->insert([
            [
                'link' => 'https://github.com/JHugoSilva',
                'icon' => 'github-alt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'link' => 'https://www.linkedin.com/in/hugo-silva-b9a666118',
                'icon' => 'linkedin-alt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'link' => 'https://www.instagram.com/hugosilva_43',
                'icon' => 'instagram-alt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
