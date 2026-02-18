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
Schema::table('atividade_alunos', function (Blueprint $table) {

    if (!Schema::hasColumn('atividade_alunos', 'link_drive')) {
        $table->string('link_drive')->nullable();
    }

    if (!Schema::hasColumn('atividade_alunos', 'feedback')) {
        $table->text('feedback')->nullable();
    }

    if (!Schema::hasColumn('atividade_alunos', 'entregue_em')) {
        $table->timestamp('entregue_em')->nullable();
    }

    if (!Schema::hasColumn('atividade_alunos', 'corrigido_em')) {
        $table->timestamp('corrigido_em')->nullable();
    }

});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('atividade_alunos', function (Blueprint $table) {
            //
        });
    }
};
