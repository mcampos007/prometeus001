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
        Schema::create('clases', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('profesor_id')->constrained('users')->onDelete('cascade'); // Relación con el modelo de profesor
            $table->dateTime('horario'); // Fecha y hora de la clase
            $table->integer('capacidad_maxima'); // Capacidad máxima de socios
            $table->integer('creditos_requeridos'); // Créditos requeridos para asistir a la clase
            $table->enum('estado', ['pendiente', 'iniciada', 'finalizada', 'inactiva'])->default('pendiente'); // Estado de la clase
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clases');
    }
};
