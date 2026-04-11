<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('skills')->truncate();

        DB::table('skills')->insert([
            // Desenvolvimento Web
            [
                'name' => 'Laravel',
                'proficiency' => 80,
                'service_id' => 1
            ],
            [
                'name' => 'PHP',
                'proficiency' => 90,
                'service_id' => 1
            ],
            [
                'name' => 'Vue.js',
                'proficiency' => 80,
                'service_id' => 1
            ],
            [
                'name' => 'React',
                'proficiency' => 25,
                'service_id' => 1
            ],

            // APIs
            [
                'name' => 'REST APIs',
                'proficiency' => 90,
                'service_id' => 2
            ],
            [
                'name' => 'JWT Auth',
                'proficiency' => 80,
                'service_id' => 2
            ],

            // Mobile
            [
                'name' => 'React Native',
                'proficiency' => 10,
                'service_id' => 3
            ],
            [
                'name' => 'Expo',
                'proficiency' => 15,
                'service_id' => 3
            ],

            // Banco de Dados
            [
                'name' => 'MySQL',
                'proficiency' => 80,
                'service_id' => 4
            ],
            [
                'name' => 'PostgreSQL',
                'proficiency' => 85,
                'service_id' => 4
            ],
        ]);
    }
}
