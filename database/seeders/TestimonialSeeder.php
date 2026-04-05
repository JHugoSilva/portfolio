<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('testimonials')->truncate();

        DB::table('testimonials')->insert([
            [
                'name' => 'Carlos Silva',
                'function' => 'Gerente de Projetos',
                'testinomy' => 'Excelente profissional, entregou tudo no prazo com alta qualidade.',
                'rating' => '5',
                'image' => 'carlos.jpg'
            ],
            [
                'name' => 'Ana Souza',
                'function' => 'CEO',
                'testinomy' => 'Muito comprometido e com grande conhecimento técnico.',
                'rating' => '5',
                'image' => 'ana.jpg'
            ],
            [
                'name' => 'João Pereira',
                'function' => 'Tech Lead',
                'testinomy' => 'Ótimo desenvolvedor, código limpo e organizado.',
                'rating' => '4',
                'image' => 'joao.jpg'
            ],
        ]);
    }
}
