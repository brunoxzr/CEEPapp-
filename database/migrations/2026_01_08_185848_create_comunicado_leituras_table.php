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
    Schema::create('comunicado_leituras', function (Blueprint $table) {
        $table->id();

        $table->foreignId('comunicado_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('aluno_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->timestamp('lido_em')->nullable();

        $table->unique(['comunicado_id', 'aluno_id']);
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comunicado_leituras');
    }
};
