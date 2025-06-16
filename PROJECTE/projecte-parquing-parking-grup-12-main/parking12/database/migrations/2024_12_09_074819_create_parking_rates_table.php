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
        Schema::create('parking_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parking_id')->constrained()->onDelete('cascade');
            $table->foreignId('rate_id')->constrained()->onDelete('cascade');
            $table->unique(['parking_id','rate_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_rates');
    }
};
