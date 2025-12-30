<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('turma_disciplinas', function (Blueprint $table) {
            $table->id();

            // Ex: "1º DS", "2º Agro"
            $table->string('turma', 50);

            // Disciplina
            $table->foreignId('disciplina_id')
                ->constrained('disciplinas')
                ->cascadeOnDelete();

            // Quantas aulas por semana essa turma precisa
            $table->unsignedTinyInteger('carga_horaria');

            $table->timestamps();

            // Evita duplicação
            $table->unique(['turma', 'disciplina_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('turma_disciplinas');
    }
};
