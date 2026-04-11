<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpa a tabela para não duplicar dados ao rodar o comando novamente
        DB::table('abouts')->truncate();

        DB::table('abouts')->insert([
            [
                'name' => 'Hugo Silva',
                'email' => 'jhugosilva@outlook.com',
                'address' => 'Natal/RN',
                'phone' => '84991154790',
                'email' => 'jhugosilva@outlook.com',

                // O QUE VOCÊ É (Focado em Keywords para SEO/Recrutadores)
                'description' => 'Desenvolvedor Pleno | Especialista PHP & Laravel | Modernização de Sistemas Legados',

                // QUEM VOCÊ É (A sua história e diferenciais - Texto mais fluido)
                'summary' => 'Com mais de 8 anos de estrada no ecossistema PHP, especializei-me em transformar sistemas complexos e legados em aplicações modernas e escaláveis. Minha base sólida em Laravel e bancos de dados SQL me permite transitar entre a manutenção crítica e a criação de novas arquiteturas do zero, sempre com foco em performance e código limpo.',

                // O SEU PROPÓSITO (Uma frase de impacto)
                'tagline' => 'Construindo soluções robustas onde o código encontra a eficiência.',

                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
