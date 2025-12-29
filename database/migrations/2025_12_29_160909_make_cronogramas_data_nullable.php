<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('cronogramas', function (Blueprint $table) {
            // se sua coluna data existe e é obrigatória, deixa opcional
            if (Schema::hasColumn('cronogramas', 'data')) {
                $table->date('data')->nullable()->change();
            }
        });
    }

    public function down(): void
    {
        Schema::table('cronogramas', function (Blueprint $table) {
            if (Schema::hasColumn('cronogramas', 'data')) {
                $table->date('data')->nullable(false)->change();
            }
        });
    }
};
