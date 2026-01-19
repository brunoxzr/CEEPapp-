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
Schema::create('regras_sequencia', function (Blueprint $table) {
    $table->id();
    $table->foreignId('admin_id')->constrained('admins')->cascadeOnDelete();

    $table->string('turma')->nullable();       // null = qualquer turma
    $table->string('dia_semana')->nullable();  // null = qualquer dia

    $table->unsignedTinyInteger('max_seguidas'); // 1,2,3...

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
