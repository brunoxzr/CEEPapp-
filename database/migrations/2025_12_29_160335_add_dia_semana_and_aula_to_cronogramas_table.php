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
    Schema::table('cronogramas', function (Blueprint $table) {
        if (!Schema::hasColumn('cronogramas', 'dia_semana')) {
            $table->string('dia_semana', 20)->nullable()->index();
        }
        if (!Schema::hasColumn('cronogramas', 'aula')) {
            $table->unsignedTinyInteger('aula')->nullable()->index();
        }
    });
}

public function down(): void
{
    Schema::table('cronogramas', function (Blueprint $table) {
        $table->dropColumn(['dia_semana', 'aula']);
    });
}


};
