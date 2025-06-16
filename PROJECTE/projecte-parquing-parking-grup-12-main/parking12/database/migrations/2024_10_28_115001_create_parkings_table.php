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
        Schema::create('parkings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->double('latitude');
            $table->double('longitude');
            $table->time('openTime');
            $table->time('closingTime');
            $table->set('parkingType', ['OpenAccess', 'PlateRecognition','AssignedSlot','AutomatedRobot']);
            $table->boolean('isOpen');
            $table->integer('availableSlots');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkings');
    }
};
