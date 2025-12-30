<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::table('admin_disciplina', function (Blueprint $table) {
            if (!Schema::hasColumn('admin_disciplina', 'carga_horaria_max')) {
                $table->unsignedTinyInteger('carga_horaria_max')
                      ->default(0);
            }
        });
    }

    public function down(): void
    {
        Schema::table('admin_disciplina', function (Blueprint $table) {
            if (Schema::hasColumn('admin_disciplina', 'carga_horaria_max')) {
                $table->dropColumn('carga_horaria_max');
            }
        });
    }
};
