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
        Schema::table('resultados_examen', function (Blueprint $table) {
            //
            $table->string('resultado')->nullable()->change(); // Permitir null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resultados_examen', function (Blueprint $table) {
            //
            $table->string('resultado')->nullable(false)->change(); // Revertir el cambio
        });
    }
};
