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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plane_id');
            $table->timestamp('date');
            $table->time('departure_time'); 
            $table->time('arrival_time'); 
            $table->foreign('plane_id')->references('id')->on('planes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('departure_location');
            $table->string('arrival_location');
            $table->integer('available_seats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
