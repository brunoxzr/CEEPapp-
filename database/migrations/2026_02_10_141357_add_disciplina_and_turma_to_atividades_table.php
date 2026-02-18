<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('atividades', function (Blueprint $table) {

            // disciplina da atividade
            $table->foreignId('disciplina_id')
                ->after('professor_id')
                ->constrained('disciplinas')
                ->cascadeOnDelete();

            // turma da atividade (ex: 3º DS)
            $table->string('turma', 50)
                ->after('disciplina_id');
        });
    }

    public function down(): void
    {
        Schema::table('atividades', function (Blueprint $table) {

            $table->dropForeign(['disciplina_id']);
            $table->dropColumn(['disciplina_id', 'turma']);
        });
    }
};
