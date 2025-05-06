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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // socio que paga
            $table->double('amount'); // monto del pago
            $table->integer('credits'); // créditos otorgados
            $table->date('payment_date'); // fecha del pago
            $table->date('expires_at'); // vencimiento de los créditos
            $table->string('method')->nullable(); // forma de pago
            $table->text('notes')->nullable(); // observaciones
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
