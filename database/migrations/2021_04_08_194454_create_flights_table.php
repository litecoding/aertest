<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('flight_number');
            $table->dateTime('departure_date_time');
            $table->dateTime('arrival_date_time');
            $table->integer('duration');

            $table->foreignId('departure_airport')->constrained('airports');
            $table->foreignId('arrival_airport')->constrained('airports');
            $table->foreignId('transporter')->constrained('transporters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flights');
    }
}
