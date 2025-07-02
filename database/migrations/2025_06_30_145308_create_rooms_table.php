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
       Schema::create('rooms', function (Blueprint $table) {
        $table->id();
        $table->foreignId('hotel_id')->constrained()->onDelete('cascade');
        $table->string('name');
        $table->string('size');
        $table->json('facilities')->nullable();
        $table->integer('units');
        $table->string('photo')->nullable();
        $table->decimal('publish_rate');
        $table->decimal('corporate_rate');
        $table->date('start_date');
        $table->date('end_date');
        $table->json('blackout_dates')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
