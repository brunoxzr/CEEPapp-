<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('smart_agro_inscricoes', function (Blueprint $table) {
            $table->id();

            // Dados do responsável
            $table->string('aluno_nome');
            $table->string('aluno_email');
            $table->string('aluno_telefone')->nullable();
            $table->string('turma');
            $table->string('ano'); // 1º, 2º, 3º

            // Professor
            $table->string('professor_orientador');

            // Projeto
            $table->string('titulo_projeto');
            $table->string('area'); // agro, biotec, digital, alimentos
            $table->text('problema');
            $table->text('solucao');
            $table->text('potencial_startup');
            $table->text('diferencial');

            // Integrantes (JSON)
            $table->json('integrantes')->nullable();

            // Avaliação interna
            $table->integer('nota_inovacao')->nullable();
            $table->integer('nota_aplicabilidade')->nullable();
            $table->integer('nota_mercado')->nullable();
            $table->integer('nota_clareza')->nullable();
            $table->integer('nota_viabilidade')->nullable();

            $table->integer('nota_total')->nullable();

            // Status
            $table->enum('status', ['pendente', 'selecionado', 'recusado'])
                  ->default('pendente');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('smart_agro_inscricoes');
    }
};
