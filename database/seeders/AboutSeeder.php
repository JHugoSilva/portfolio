<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpa a tabela para não duplicar dados ao rodar o comando novamente
        DB::table('abouts')->truncate();

        DB::table('abouts')->insert([
            [
                'name' => 'Hugo Silva',
                'email' => 'jhugosilva@outlook.com',
                'address' => 'Natal/RN',
                'description' => 'Desenvolvedor Web Full Stack com foco em Back-End, 8+ anos de experiência em PHP/Laravel e forte atuação em manutenção e evolução de sistemas legados.',
                'summary' => 'Desenvolvedor Web Full Stack com foco em back-end e mais de 8 anos de experiência no
                    desenvolvimento de aplicações web. Possui sólida atuação com PHP e Laravel, além de
                    experiência com manutenção e evolução de sistemas legados.',
                'tagline' => 'Transformando ideias em código',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
