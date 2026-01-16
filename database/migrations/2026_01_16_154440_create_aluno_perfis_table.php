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
Schema::create('aluno_perfis', function (Blueprint $table) {
    $table->id();

    $table->foreignId('aluno_id')->constrained('alunos')->onDelete('cascade');

    $table->string('foto')->nullable();
    $table->string('linkedin')->nullable();
    $table->string('github')->nullable();
    $table->string('portfolio')->nullable();

    $table->string('curso');
    $table->string('ano'); // ex: 2024, 2025
    $table->text('bio')->nullable();

    $table->boolean('publico')->default(true);

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aluno_perfis');
    }
};
