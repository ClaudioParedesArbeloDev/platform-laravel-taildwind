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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('days1')->nullable();
            $table->string('days2')->nullable();
            $table->integer('enroll_day_1')->default(20);
            $table->integer('enroll_day_2')->default(20);
            $table->string('duration')->nullable();
            $table->string('category')->nullable();
            $table->integer('capacity')->nullable();
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
        Schema::dropIfExists('courses');
    }
};
