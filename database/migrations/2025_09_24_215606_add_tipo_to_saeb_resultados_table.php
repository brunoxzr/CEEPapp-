<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('saeb_resultados', function (Blueprint $table) {
            $table->string('tipo', 20)->nullable(); // LP1, LP2, MT1, MT2, SAEB
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('saeb_resultados', function (Blueprint $table) {
            //
        });
    }
};
