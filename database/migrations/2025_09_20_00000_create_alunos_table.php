<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('senha'); // hash
            $table->enum('escola', ['CEEP', 'CARRAO'])->default('CEEP');
            $table->string('turma')->nullable(); // Ex: 2º DS-A, 1º Química, etc.
            $table->date('nascimento')->nullable();
            $table->string('matricula')->unique()->nullable();
            $table->timestamps();
            $table->index(['escola', 'turma']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
