<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->nullable();
            $table->string('date')->nullable();

            // Usamos text para URLs longas ou se houver muitos parâmetros
            $table->text('videoUrl')->nullable();
            $table->text('projectLink')->nullable();

            // longText é ideal para o conteúdo do editor profissional (HTML pesado)
            $table->longText('longDescription')->nullable();

            // Para a imagem, geralmente guardamos apenas o caminho (path) da string
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
