<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('professor_restricoes', function (Blueprint $table) {
            $table->id();

            // Professor (admins com role = professor)
            $table->foreignId('admin_id')
                ->constrained('admins')
                ->cascadeOnDelete();

            // Segunda, Terça, Quarta...
            $table->string('dia_semana', 20);

            /**
             * Aula específica (1 a 6)
             * null = dia inteiro bloqueado
             */
            $table->unsignedTinyInteger('aula')->nullable();

            // Observação opcional (ex: reunião, outro colégio, etc)
            $table->string('motivo')->nullable();

            $table->timestamps();

            // Evita duplicação
            $table->unique(['admin_id', 'dia_semana', 'aula']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('professor_restricoes');
    }
};
