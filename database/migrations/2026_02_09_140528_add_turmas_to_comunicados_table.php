<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasColumn('comunicados', 'turma')) {
            Schema::table('comunicados', function (Blueprint $table) {
                $table->dropColumn('turma');
            });
        }

        if (!Schema::hasColumn('comunicados', 'turmas')) {
            Schema::table('comunicados', function (Blueprint $table) {
                $table->json('turmas')->nullable()->after('publico');
            });
        }
    }

    public function down(): void
    {
        Schema::table('comunicados', function (Blueprint $table) {
            if (Schema::hasColumn('comunicados', 'turmas')) {
                $table->dropColumn('turmas');
            }

            if (!Schema::hasColumn('comunicados', 'turma')) {
                $table->string('turma')->nullable();
            }
        });
    }
};
