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
    Schema::create('aprovados', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->string('curso');
        $table->string('aprovado_em'); // universidade / empresa
        $table->string('ano')->nullable();
        $table->boolean('ativo')->default(true);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('aprovados');
}


};
