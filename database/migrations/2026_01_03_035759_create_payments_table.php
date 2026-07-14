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
            
            // Relaciones
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Usuario que realizó el pago');
            
            $table->foreignId('course_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Curso al que se inscribió');
            
          
            $table->string('payment_id')
                ->nullable()
                ->index()
                ->comment('ID del pago en Mercado Pago');
            
            $table->string('preference_id')
                ->nullable()
                ->comment('ID de preferencia de Mercado Pago');
            
            
            $table->decimal('amount', 10, 2)
                ->comment('Monto del pago');
            
            $table->string('status')
                ->default('pending')
                ->index()
                ->comment('Estado del pago: pending, approved, rejected, cancelled, in_process, in_mediation, refunded, charged_back');
            
            $table->string('payment_method')
                ->nullable()
                ->comment('Método de pago (tarjeta, efectivo, etc)');
            
            $table->string('payment_type')
                ->nullable()
                ->comment('Tipo de pago (credit_card, debit_card, ticket, etc)');
            
            
            $table->integer('enroll_day')
                ->nullable()
                ->comment('Día de inscripción si el curso tiene horarios múltiples (1 o 2)');
            
           
            $table->json('metadata')
                ->nullable()
                ->comment('Información adicional del pago en formato JSON');
            
            $table->timestamps();
            
           
            $table->index(['user_id', 'course_id', 'status'], 'user_course_status_idx');
            $table->index(['status', 'created_at'], 'status_created_idx');
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