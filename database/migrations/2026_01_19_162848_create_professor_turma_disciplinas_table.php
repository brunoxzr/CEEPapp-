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
Schema::create('professor_turma_disciplinas', function (Blueprint $table) {
    $table->id();

    $table->foreignId('admin_id')->constrained('admins')->cascadeOnDelete();
    $table->string('turma');
    $table->foreignId('disciplina_id')->constrained('disciplinas')->cascadeOnDelete();

    $table->unsignedTinyInteger('aulas_semana'); // DEMANDA REAL

    $table->timestamps();

    $table->unique(['admin_id','turma','disciplina_id']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professor_turma_disciplinas');
    }
};
