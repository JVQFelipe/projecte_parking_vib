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
        Schema::table('users', function (Blueprint $table) {

            //Afegeixo relació amb parking, que sigui nullable i que si s'elimina el parking 
            $table->unsignedBigInteger('parking_id')->nullable();
            $table->foreign('parking_id')->references('id')->on('parkings')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['parking_id']);
            $table->dropColumn('parking_id');
        });
    }
};
