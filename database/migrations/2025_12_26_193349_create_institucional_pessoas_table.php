<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('institucional_pessoas', function (Blueprint $table) {
            $table->id();

            $table->string('nome');
            $table->string('slug')->unique();

            $table->string('cargo');          // Diretor, Pedagogo, Coordenação, etc.
            $table->unsignedTinyInteger('nivel'); // 1 topo, 2, 3, 4...
            $table->unsignedInteger('ordem')->default(0); // para ordenar dentro do nível (opcional)

            $table->text('biografia')->nullable();
            $table->string('foto')->nullable(); // caminho no storage/public

            $table->boolean('ativo')->default(true);

            $table->timestamps();

            $table->index(['nivel', 'ordem']);
            $table->index(['ativo']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institucional_pessoas');
    }
};
