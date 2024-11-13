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
        Schema::create('work_days', function (Blueprint $table) {
            $table->id();

            $table->string('day'); // Día de la semana, por ejemplo 'lunes', 'martes'
            $table->boolean('active')->default(false); // Define si el día está activo
            $table->time('morning_start')->nullable(); // Hora de inicio de la mañana
            $table->time('morning_end')->nullable();   // Hora de finalización de la mañana
            $table->time('afternoon_start')->nullable(); // Hora de inicio de la tarde
            $table->time('afternoon_end')->nullable();   // Hora de finalización de la tarde
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Clave foránea a users

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_days');
    }
};
