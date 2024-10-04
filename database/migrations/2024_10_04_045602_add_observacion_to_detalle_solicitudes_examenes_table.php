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
        Schema::table('detalle_solicitudes_examenes', function (Blueprint $table) {
            //
            $table->text('observacion')->nullable()->after('examen_id'); // Añadir columna observacion
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detalle_solicitudes_examenes', function (Blueprint $table) {
            //
            $table->dropColumn('observacion');
        });
    }
};
