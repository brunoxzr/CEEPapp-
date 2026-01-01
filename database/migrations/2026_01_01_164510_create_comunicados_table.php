<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comunicados', function (Blueprint $table) {
            $table->id();

            $table->string('titulo', 200);
            $table->text('conteudo'); // HTML (editor tipo Word)

            // público alvo
            $table->enum('publico', ['geral', 'turma', 'curso'])->default('geral');

            // filtros opcionais
            $table->string('turma')->nullable();
            $table->string('curso')->nullable();

            // quem criou
            $table->foreignId('criado_por')
                  ->constrained('admins')
                  ->cascadeOnDelete();

            // controle
            $table->boolean('ativo')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comunicados');
    }
};
