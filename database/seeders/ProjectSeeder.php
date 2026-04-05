<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->truncate();

        DB::table('projects')->insert([
            [
                'title' => 'Sistema de Portfólio',
                'description' => 'Aplicação completa com Laravel e Vue.js para exibir projetos, serviços e contatos.',
                'link' => 'https://github.com/seu-user/portfolio',
                'image' => 'portfolio.png'
            ],
            [
                'title' => 'API eSocial',
                'description' => 'API em Node.js para integração com o eSocial, seguindo boas práticas e autenticação segura.',
                'link' => 'https://github.com/seu-user/esocial-api',
                'image' => 'esocial.png'
            ],
            [
                'title' => 'App de Filmes',
                'description' => 'Aplicação em Vue.js consumindo a API do TMDB com favoritos e filtros por gênero.',
                'link' => 'https://github.com/seu-user/movies-app',
                'image' => 'movies.png'
            ],
        ]);
    }
}
