<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('software_order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('software_order_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('software_id')
                ->constrained('softwares')
                ->onDelete('cascade');

            $table->foreignId('software_addon_id')
                ->nullable()
                ->constrained('software_addons')
                ->onDelete('set null');

            
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('quantity')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('software_order_items');
    }
};