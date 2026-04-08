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
        // Limpa a tabela para não duplicar dados ao rodar o comando novamente
        \DB::table('abouts')->truncate();

        \DB::table('abouts')->insert([
            [
                'name' => 'João Hugo',
                'email' => 'joao@email.com',
                'address' => 'Natal - RN',
                'description' => 'Desenvolvedor Full Stack com foco em Laravel e Vue.js',
                'summary' => 'Experiência sólida em backend e frontend moderno',
                'tagline' => 'Transformando ideias em código',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
