<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('experiences')->truncate();

        DB::table('experiences')->insert([
            [
                'company' => 'DBSeller',
                'period' => '2022 - Atual',
                'position' => 'Desenvolvedor Full Stack'
            ],
            [
                'company' => 'Freelancer',
                'period' => '2020 - 2022',
                'position' => 'Desenvolvedor Web'
            ],
            [
                'company' => 'Projetos Pessoais',
                'period' => '2019 - Atual',
                'position' => 'Desenvolvedor'
            ],
        ]);
    }
}
