<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('presidentes_turma', function (Blueprint $table) {
            $table->id();

            $table->foreignId('aluno_id')
                ->constrained('alunos')
                ->cascadeOnDelete();

            $table->string('turma', 100);

            $table->boolean('ativo')->default(true);

            $table->timestamps();

            $table->unique(['aluno_id', 'turma']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presidentes_turma');
    }
};