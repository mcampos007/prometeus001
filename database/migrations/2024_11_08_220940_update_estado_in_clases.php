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
        Schema::table('clases', function (Blueprint $table) {
            //
            // Cambiar el campo 'estado' para tener solo 'activa' o 'inactiva'
        //$table->enum('estado', ['activa', 'inactiva'])->default('activa')->change();
        $table->enum('estado', ['pendiente', 'iniciada', 'finalizada', 'inactiva'])->default('pendiente')->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clases', function (Blueprint $table) {
            //
            // Deshacer el cambio si es necesario
        $table->enum('estado', ['pendiente', 'iniciada', 'finalizada', 'inactiva'])->default('pendiente')->change();

        });
    }
};
