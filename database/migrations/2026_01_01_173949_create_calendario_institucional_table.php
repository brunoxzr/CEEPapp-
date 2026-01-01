<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('calendario_institucional', function (Blueprint $table) {
            $table->id();

            $table->string('titulo');
            $table->text('descricao')->nullable();

            $table->date('data');
            $table->time('hora_inicio')->nullable();
            $table->time('hora_fim')->nullable();

            $table->string('tipo', 50); // reuniao, evento, conselho, data
            $table->string('publico', 20)->default('todos'); // alunos, professores, todos

            $table->boolean('ativo')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calendario_institucional');
    }
};
