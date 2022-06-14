<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_rides', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('current_location');
            $table->string('destination');
            $table->string('price_of_ride')->nullable();
            $table->string('parcel_delivery_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_rides');
    }
}
