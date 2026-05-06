<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chamadas_turma', function (Blueprint $table) {
            $table->id();

            $table->string('turma', 100);
            $table->date('data');
            $table->string('aula', 50)->nullable();
            $table->text('observacao')->nullable();

            $table->foreignId('presidente_id')
                ->constrained('alunos')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chamadas_turma');
    }
};