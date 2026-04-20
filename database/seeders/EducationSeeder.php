<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('educations')->truncate();

        $educations = [
            [
                'institution' => 'IMD - Instituto Metrópole Digital (UFRN)',
                'degree' => 'Técnico em Tecnologia da Informação',
                'description' => 'Desenvolvimento de sistemas, infraestrutura e banco de dados.',
                'start_date' => '2016-02-01', // Ajuste para sua data real
                'end_date' => '2018-12-12', // Em andamento
                'is_current' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'institution' => 'Centro Universitário Anhanguera',
                'degree' => 'Análise e Desenvolvimento de Sistemas',
                'description' => 'Foco em engenharia de software, linguagens de programação e gestão de projetos de TI.',
                'start_date' => '2025-08-01', // Ajuste para sua data real
                'end_date' => null, // Em andamento
                'is_current' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('educations')->insert($educations);
    }
}
