<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */public function up(): void
{
    Schema::table('cronogramas', function (Blueprint $table) {
        if (!Schema::hasColumn('cronogramas', 'aula')) {
            $table->integer('aula')->after('turma');
        }
    });
}

public function down(): void
{
    Schema::table('cronogramas', function (Blueprint $table) {
        if (Schema::hasColumn('cronogramas', 'aula')) {
            $table->dropColumn('aula');
        }
    });
}

};
