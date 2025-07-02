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
       Schema::create('bookings', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('hotel_id')->constrained()->onDelete('cascade');
    $table->foreignId('room_id')->constrained()->onDelete('cascade');
    $table->date('tanggal_checkin');
    $table->date('tanggal_checkout');
    $table->integer('jumlah_kamar');
    $table->bigInteger('total_harga');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
