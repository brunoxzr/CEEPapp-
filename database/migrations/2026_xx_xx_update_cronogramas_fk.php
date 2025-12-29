<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cronogramas', function (Blueprint $table) {

            // FK para professor (admin com role professor)
            $table->foreignId('professor_id')
                  ->nullable()
                  ->after('turma')
                  ->constrained('admins')
                  ->nullOnDelete();

            // FK para disciplina
            $table->foreignId('disciplina_id')
                  ->nullable()
                  ->after('professor_id')
                  ->constrained('disciplinas')
                  ->nullOnDelete();

            // Índices úteis
            $table->index(['professor_id', 'disciplina_id']);
        });
    }

    public function down(): void
    {
        Schema::table('cronogramas', function (Blueprint $table) {
            $table->dropForeign(['professor_id']);
            $table->dropForeign(['disciplina_id']);

            $table->dropColumn([
                'professor_id',
                'disciplina_id'
            ]);
        });
    }
};
