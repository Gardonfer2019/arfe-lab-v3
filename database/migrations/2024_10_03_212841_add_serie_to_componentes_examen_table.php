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
        Schema::table('componentes_examen', function (Blueprint $table) {
            //
            $table->foreignId('serie_id')->nullable()->constrained('series')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('componentes_examen', function (Blueprint $table) {
            //
        });
    }
};
