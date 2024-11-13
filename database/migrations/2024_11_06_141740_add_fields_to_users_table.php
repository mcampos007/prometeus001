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
        Schema::table('users', function (Blueprint $table) {
            //
            // Campo 'role' como ENUM con los valores especificados
        $table->enum('role', ['socio', 'administrador', 'profesor'])->default('socio');

        // Campo 'credits' con un valor predeterminado de 0
        $table->integer('credits')->default(0);

        // Campo 'credit_vto' con la fecha predeterminada de hoy más 30 días
        $table->date('credit_vto')->default(now()->addDays(30));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn(['role', 'credits', 'credit_vto']);
        });
    }
};
