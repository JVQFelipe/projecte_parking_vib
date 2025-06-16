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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('plate');
            $table->dateTime('entryTime');
            $table->dateTime('exitTime')->nullable();
            $table->integer('totalTime')->nullable();
            $table->double('totalPay')->nullable();
            $table->set('paymentOption', ['card', 'cash','paypal','bitcoin','coupon'])->nullable();
            $table->boolean('isPaid')->nullable();
            $table->foreignId('parking_id')->constrained('parkings')->onDelete('cascade');
            $table->foreignId('parkingslot_id')->nullable()->constrained('parkingslots')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
