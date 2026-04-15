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
                'title' => 'Desenvolvimento Backend com Laravel',
                'category' => 'Desenvolvimento de Software',
                'description' => 'Desenvolvimento de aplicações robustas e escaláveis utilizando PHP 8 e ecossistema Laravel. Experiência avançada em refatoração de código legado e implementação de arquiteturas modernas.',
                'technologies' => 'PHP, Laravel, Git',
                'experience_level' => 'Sênior/Pleno',
            ],
            [
                'title' => 'Desenvolvimento e Integração de APIs RESTful',
                'category' => 'Desenvolvimento de APIs',
                'description' => 'Especialista na arquitetura e desenvolvimento de APIs modernas e escaláveis. Experiência sólida na criação de endpoints seguros, comunicação entre microserviços e integração com sistemas governamentais e serviços de terceiros.',
                'technologies' => 'REST, JSON, XML, OAuth2, Webhooks, eSocial API',
                'experience_level' => 'Especialista',
            ],
            [
                'title' => 'Desenvolvimento de Queries Avançadas e Persistência de Dados',
                'category' => 'Database & Backend',
                'description' => 'Domínio em SQL avançado para otimização de performance e análise de dados complexos. Especialista na integração eficiente entre camadas de banco de dados e backend (ORM/Eloquent), garantindo integridade e velocidade em sistemas de alta volumetria.',
                'technologies' => 'PostgreSQL, MySQL, SQL Server, Eloquent ORM, Query Optimization',
                'experience_level' => 'Pleno/Especialista',
            ],
            [
                'title' => 'Desenvolvimento FullStack e Interfaces',
                'category' => 'Web Design',
                'description' => 'Criação de interfaces dinâmicas e responsivas integrando o backend Laravel com tecnologias frontend clássicas e modernas.',
                'technologies' => 'JavaScript, jQuery, HTML5, CSS3',
                'experience_level' => 'Pleno',
            ],
            [
                'title' => 'Consultoria Técnica e Infraestrutura VPS',
                'category' => 'DevOps / Consultoria',
                'description' => 'Configuração de servidores VPS para hospedagem, suporte técnico especializado e deploy de aplicações.',
                'technologies' => 'VPS, Linux, Deployment, Git',
                'experience_level' => 'Intermediário',
            ],
        ]);
    }
}
