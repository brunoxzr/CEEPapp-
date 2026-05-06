<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chamada_turma_alunos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('chamada_turma_id')
                ->constrained('chamadas_turma')
                ->cascadeOnDelete();

            $table->foreignId('aluno_id')
                ->constrained('alunos')
                ->cascadeOnDelete();

            $table->boolean('presente')->default(false);

            $table->timestamps();

            $table->unique(['chamada_turma_id', 'aluno_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chamada_turma_alunos');
    }
};