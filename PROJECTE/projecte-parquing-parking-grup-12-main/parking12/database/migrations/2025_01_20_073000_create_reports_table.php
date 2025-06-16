<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
            $table->double('total_ingressos');
            $table->integer('total_tickets'); 
            $table->double('avg_time');
            $table->foreignId('parking_id')->constrained()->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
