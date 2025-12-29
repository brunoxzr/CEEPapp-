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
Schema::create('projetos', function (Blueprint $table) {
    $table->id();
    $table->string('titulo');
    $table->string('slug')->unique();
    $table->text('descricao');
    $table->string('area'); // Sistemas, Mecânica, Agro, etc
    $table->json('tecnologias')->nullable();
    $table->foreignId('professor_id')->constrained('admins')->cascadeOnDelete();
    $table->string('capa_imagem')->nullable();
    $table->enum('status', ['rascunho', 'publicado'])->default('rascunho');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projetos');
    }
};
