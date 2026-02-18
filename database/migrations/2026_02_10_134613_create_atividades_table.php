<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('atividades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('professor_id');
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->date('data_limite')->nullable();
            $table->timestamps();

            $table->foreign('professor_id')
                ->references('id')
                ->on('admins')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('atividades');
    }
};
