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
        Schema::create('softwares', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->nullable()->unique()->comment('Código interno del producto, ej: BOUWEB');
            $table->string('name');
            $table->string('short_description')->nullable();
            $table->text('description');
            $table->string('image')->nullable();


            $table->string('type')->default('generico')->comment('generico | medida');
            $table->string('platform')->nullable()->comment('web, windows, mobile, desktop');
            $table->string('license_type')->nullable()->comment('unica (pago único) | anual (licencia anual) | null');

         
            $table->decimal('price', 10, 2)->nullable()->comment('Null = a consultar');
            $table->boolean('requires_quote')->default(false)->comment('Si es true, no se puede comprar online, sólo cotizar');

         
            $table->string('demo_url')->nullable();
            $table->string('manual_url')->nullable();
            $table->string('download_url')->nullable()->comment('Sólo se entrega al comprador tras el pago aprobado');
            $table->string('purchase_url')->nullable()->comment('Si está seteada, el botón Comprar redirige acá en vez de usar el checkout interno');

            $table->string('category')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('active')->default(true);

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('softwares');
    }
};