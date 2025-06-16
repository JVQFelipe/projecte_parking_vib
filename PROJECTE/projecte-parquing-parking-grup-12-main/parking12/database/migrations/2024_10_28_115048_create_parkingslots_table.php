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
        Schema::create('parkingslots', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->set('slotType', ['motorbike', 'normal','big','adapted']);
            $table->set('slotStatus', ['closed', 'open','occupied',]);
            $table->boolean('assigned')->nullable();
            $table->string('plate')->nullable();
            $table->string('assignedPlate')->nullable();
            $table->double('x1');
            $table->double('y1');
            $table->double('x2');
            $table->double('y2');
            $table->foreignId('floor_id')->constrained('floors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkingslots');
    }
};
