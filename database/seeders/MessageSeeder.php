<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('messages')->truncate();

        DB::table('messages')->insert([
            [
                'name' => 'João Silva',
                'email' => 'joao@email.com',
                'subject' => 'Proposta de Projeto',
                'description' => 'Gostaria de conversar sobre um novo projeto web.',
                'status' => true,
            ],
            [
                'name' => 'Maria Souza',
                'email' => 'maria@email.com',
                'subject' => 'Dúvida sobre serviço',
                'description' => 'Você trabalha com APIs em Laravel?',
                'status' => false,
            ],
            [
                'name' => 'Carlos Pereira',
                'email' => 'carlos@email.com',
                'subject' => 'Orçamento',
                'description' => 'Preciso de um orçamento para um sistema interno.',
                'status' => true,
            ],
        ]);
    }
}
