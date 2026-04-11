<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->truncate();

        DB::table('services')->insert([
            [
                'name' => 'Desenvolvimento Web',
                'icon' => 'mdi-web',
                'description' => 'Criação de sistemas web modernos usando Laravel, Vue.js e boas práticas.'
            ],
            [
                'name' => 'APIs REST',
                'icon' => 'mdi-api',
                'description' => 'Desenvolvimento de APIs escaláveis e seguras para integração de sistemas.'
            ],
            [
                'name' => 'Aplicações Mobile',
                'icon' => 'mdi-cellphone',
                'description' => 'Desenvolvimento de apps com React Native e Expo.'
            ],
            [
                'name' => 'Banco de Dados',
                'icon' => 'mdi-database',
                'description' => 'Modelagem e otimização de bancos de dados relacionais.'
            ],
            [
                'name' => 'Manutenção de Sistemas',
                'icon' => 'mdi-tools',
                'description' => 'Correções, melhorias e refatoração de sistemas existentes.'
            ],
        ]);
    }
}
