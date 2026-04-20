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
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('institution');    // IMD, Anhanguera, etc.
            $table->string('degree');         // ADS, Técnico em TI, etc.
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();    // Null significa "Em andamento"
            $table->boolean('is_current')->default(false); // Reforça se é atual
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
