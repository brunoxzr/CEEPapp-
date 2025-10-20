<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('cronogramas', function (Blueprint $table) {
            $table->string('dia_semana', 20)->nullable()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('cronogramas', function (Blueprint $table) {
            $table->dropColumn('dia_semana');
        });
    }
};
