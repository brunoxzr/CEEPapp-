<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projeto_contribuicoes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('projeto_id')
                ->constrained('projetos')
                ->cascadeOnDelete();

            $table->foreignId('aluno_id')
                ->constrained('alunos')
                ->cascadeOnDelete();

            $table->string('funcao')->nullable(); // ex: Backend, UI, Pesquisa
            $table->text('descricao')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projeto_contribuicoes');
    }
};
