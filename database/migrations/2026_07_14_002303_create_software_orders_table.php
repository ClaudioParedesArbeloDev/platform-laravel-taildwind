<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('software_orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->decimal('total', 10, 2);

            $table->string('status')
                ->default('pending')
                ->index()
                ->comment('pending, approved, rejected, cancelled, in_process, refunded');

            
            $table->string('preference_id')->nullable();
            $table->string('payment_id')->nullable()->index();
            $table->string('payment_method')->nullable();
            $table->string('payment_type')->nullable();
            $table->json('metadata')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'status'], 'software_orders_user_status_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('software_orders');
    }
};