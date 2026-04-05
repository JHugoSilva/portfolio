<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::factory()->count(10)->create();

        // About::factory()->create([
        //     'name' => 'João Hugo',
        //     'email' => 'joao@email.com',
        //     'address' => 'Natal - RN',
        //     'description' => 'Desenvolvedor Full Stack com foco em Laravel e Vue.js',
        //     'summary' => 'Experiência sólida em backend e frontend moderno',
        //     'tagline' => 'Transformando ideias em código',
        // ]);
    }
}
