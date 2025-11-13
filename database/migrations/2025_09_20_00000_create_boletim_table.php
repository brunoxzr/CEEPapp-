<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('boletins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained('alunos')->onDelete('cascade');
            $table->string('disciplina');
            $table->decimal('nota', 5, 2)->default(0.00);
            $table->string('tipo')->default('Prova Interna'); // SAEB, Prova Interna etc.
            $table->string('etapa')->nullable(); // Bimestre / Avaliação
            $table->integer('ano')->default(date('Y'));
            $table->text('observacoes')->nullable();
            $table->timestamps();
            $table->index(['aluno_id', 'disciplina', 'ano']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('boletins');
    }
};
