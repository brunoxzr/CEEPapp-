<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('saeb_resultados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained('alunos')->onDelete('cascade');

            $table->string('disciplina');     // LP, MT, etc.
            $table->integer('ano');           // 2025
            $table->string('etapa')->nullable(); // Ex: "2ª Prova"

            $table->decimal('media', 5, 2);   // Média calculada
            $table->json('detalhes')->nullable(); // Armazena notas por habilidade (H01…H15)

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saeb_resultados');
    }
};
