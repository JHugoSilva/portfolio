<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('experiences')->truncate();

        $experiences = [
            [
                'company' => 'DBSeller Serviços de Informática',
                'role' => 'Desenvolvedor Pleno',
                'location' => 'Remoto',
                'start_date' => Carbon::parse('2022-01-01'),
                'end_date' => Carbon::parse('2026-02-01'),
                'description' => 'Desenvolvimento e manutenção de sistemas com PHP 8 e Laravel. Foco em refatoração de código legado, integração com API do eSocial e manipulação avançada de PostgreSQL.',
                'technologies' => 'PHP, Laravel, PostgreSQL, eSocial API, Git, VPN',
            ],
            [
                'company' => 'TecnoTech Sistemas',
                'role' => 'Desenvolvedor Pleno',
                'location' => 'Híbrido',
                'start_date' => Carbon::parse('2021-09-01'),
                'end_date' => Carbon::parse('2022-01-01'),
                'description' => 'Atuação em código legado e manutenção evolutiva utilizando PHP/Laravel e JavaScript/jQuery.',
                'technologies' => 'PHP, Laravel, JavaScript, jQuery, PostgreSQL, Git',
            ],
            [
                'company' => 'G Trigueiro Tecnologia',
                'role' => 'Desenvolvedor Pleno',
                'location' => 'Presencial',
                'start_date' => Carbon::parse('2020-11-01'),
                'end_date' => Carbon::parse('2021-09-01'),
                'description' => 'Desenvolvimento de aplicações web e integração com múltiplos bancos de dados (MySQL e SQL Server).',
                'technologies' => 'PHP, Laravel, MySQL, SQL Server, JavaScript, Git',
            ],
            [
                'company' => 'CTSI',
                'role' => 'Desenvolvedor Pleno',
                'location' => 'Presencial',
                'start_date' => Carbon::parse('2020-02-01'),
                'end_date' => Carbon::parse('2020-11-01'),
                'description' => 'Desenvolvimento com PHP puro, CodeIgniter e Laravel. Foco em sistemas internos e bancos SQL.',
                'technologies' => 'PHP, CodeIgniter, Laravel, MySQL, SQL Server, Git',
            ],
            [
                'company' => 'Freelancer',
                'role' => 'Desenvolvedor Web FullStack',
                'location' => 'Remoto',
                'start_date' => Carbon::parse('2018-01-01'),
                'end_date' => Carbon::parse('2020-12-31'),
                'description' => 'Criação de sites institucionais, configuração de servidores VPS e suporte direto ao cliente final.',
                'technologies' => 'PHP, HTML, CSS, JavaScript, VPS Hosting, Git',
            ],
            [
                'company' => 'DigiSaúde',
                'role' => 'Desenvolvedor Júnior',
                'location' => 'Presencial',
                'start_date' => Carbon::parse('2017-01-01'),
                'end_date' => Carbon::parse('2018-01-01'),
                'description' => 'Início da trajetória profissional com foco em PHP puro e manutenção de bancos MySQL.',
                'technologies' => 'PHP, MySQL, JavaScript, jQuery, Git',
            ],
        ];

        foreach ($experiences as $exp) {
            DB::table('experiences')->insert(array_merge($exp, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
