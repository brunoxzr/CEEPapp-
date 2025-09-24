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
        Schema::create('cronogramas', function (Blueprint $table) {
            $table->id();

            // Data do cronograma (ex: 2025-09-22)
            $table->date('data');

            // Identificação da turma
            $table->string('turma', 100);

            // Disciplina e professor
            $table->string('disciplina', 150);
            $table->string('professor', 150);

            // Horário de início e fim
            $table->time('inicio');
            $table->time('fim');

            // Sala de aula (opcional)
            $table->string('sala', 50)->nullable();

            // Observações adicionais
            $table->text('observacoes')->nullable();

            $table->timestamps();

            // Índices para facilitar consultas
            $table->index(['data', 'turma']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cronogramas');
    }
};
