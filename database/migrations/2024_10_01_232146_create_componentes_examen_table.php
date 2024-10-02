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
        Schema::create('componentes_examen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('examen_id')->constrained('examenes')->onDelete('cascade');
            $table->string('nombre_componente', 100);
            $table->string('abreviatura', 50)->nullable();
            $table->string('unidad', 20)->nullable();
            $table->decimal('valor_referencia_min', 10, 2)->nullable();
            $table->decimal('valor_referencia_max', 10, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('componentes_examen');
    }
};
