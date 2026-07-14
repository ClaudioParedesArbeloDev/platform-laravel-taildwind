<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_software', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('software_id')
                ->constrained('softwares')
                ->onDelete('cascade');

            $table->foreignId('software_order_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');

            $table->string('status')
                ->default('active')
                ->comment('active, pending_delivery (a medida en proceso), expired');

            $table->string('license_type')->nullable()->comment('unica | anual');
            $table->timestamp('purchased_at')->nullable();
            $table->timestamp('expires_at')->nullable()->comment('Sólo aplica a licencias anuales');
            $table->string('download_token')->nullable()->unique();

            $table->timestamps();

            $table->index(['user_id', 'software_id'], 'user_software_user_software_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_software');
    }
};