<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('atividade_alunos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('atividade_id');
            $table->unsignedBigInteger('aluno_id');
            $table->string('status')->nullable(); // fez, nao_fez, atrasado
            $table->decimal('nota', 5, 2)->nullable();
            $table->text('observacao')->nullable();
            $table->timestamp('marcado_em')->nullable();
            $table->timestamps();

            $table->unique(['atividade_id', 'aluno_id']);

            $table->foreign('atividade_id')
                ->references('id')
                ->on('atividades')
                ->onDelete('cascade');

            $table->foreign('aluno_id')
                ->references('id')
                ->on('alunos')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('atividade_alunos');
    }
};
