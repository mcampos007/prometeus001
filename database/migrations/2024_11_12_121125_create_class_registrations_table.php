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
        Schema::create('class_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('socio_id')->constrained('users')->onDelete('cascade'); // Relación con el usuario/socio
            $table->foreignId('clase_id')->constrained('clases')->onDelete('cascade'); // Relación con la clase
            $table->enum('estado_inscripcion', ['pendiente', 'presente', 'ausente'])->default('pendiente'); // Estado de inscripción
            $table->date('fecha_inscripcion'); // Fecha de inscripción
            $table->boolean('presencia_confirmada')->default(false); // Presencia confirmada
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_registrations');
    }
};
