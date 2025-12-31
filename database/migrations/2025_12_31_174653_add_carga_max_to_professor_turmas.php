<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('professor_turmas', function (Blueprint $table) {
            $table->unsignedSmallInteger('carga_max')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('professor_turmas', function (Blueprint $table) {
            $table->dropColumn('carga_max');
        });
    }
};
