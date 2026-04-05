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
        DB::table('education')->truncate();

        DB::table('education')->insert([
            [
                'institution' => 'Instituto Metrópole Digital',
                'period' => '2018 - 2020',
                'degree' => 'Técnico',
                'departement' => 'Tecnologia da Informação'
            ],
            [
                'institution' => 'UNICID',
                'period' => '2021 - Atual',
                'degree' => 'Graduação',
                'departement' => 'Análise e Desenvolvimento de Sistemas'
            ],
            [
                'institution' => 'Cursos Online',
                'period' => '2020 - Atual',
                'degree' => 'Certificações',
                'departement' => 'Laravel, Vue.js, React, APIs REST'
            ],
        ]);
    }
}
