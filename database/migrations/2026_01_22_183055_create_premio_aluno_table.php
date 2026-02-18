<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('premio_aluno', function (Blueprint $table) {
        $table->id();

        $table->foreignId('premio_id')
              ->constrained('premios')
              ->cascadeOnDelete();

        $table->foreignId('aluno_id')
              ->constrained('alunos')
              ->cascadeOnDelete();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premio_aluno');
    }
};
