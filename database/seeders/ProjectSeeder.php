<?php

namespace Database\Seeders;

use App\Models\Project;
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

        Project::create([
            'title' => 'E-commerce Moderno com Vue 3',
            'category' => 'Desenvolvimento Web',
            'date' => 'Março, 2024',
            'videoUrl' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', // Link de embed
            'projectLink' => 'https://github.com/seu-usuario/projeto-exemplo',
            'longDescription' => '
                <h2>Sobre o Projeto</h2>
                <p>Este projeto foi desenvolvido utilizando <strong>Laravel 11</strong> no backend e <strong>Vue.js 3</strong> com <strong>TypeScript</strong> no frontend.</p>
                <ul>
                    <li>Integração com API de pagamentos.</li>
                    <li>Painel administrativo customizado.</li>
                    <li>Design responsivo com Tailwind CSS.</li>
                </ul>
                <p>O foco principal foi a performance e a segurança dos dados dos usuários.</p>
            ',
            'image' => 'project_demo.jpg' // Nome de um arquivo que exista no seu storage
        ]);

        Project::create([
            'title' => 'Sistema de Gestão Imobiliária',
            'category' => 'Sistemas Internos',
            'date' => 'Janeiro, 2024',
            'videoUrl' => null,
            'projectLink' => 'https://imobiliaria-demo.com',
            'longDescription' => '
                <h2>Solução Corporativa</h2>
                <p>Um sistema completo para gerenciamento de aluguéis e vendas. Possui geração automática de contratos e controle de inadimplência.</p>
            ',
            'image' => 'imobiliaria_demo.jpg'
        ]);
    }
}
