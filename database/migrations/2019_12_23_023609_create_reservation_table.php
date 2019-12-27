<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('row');
            $table->integer('column');
            $table->bigInteger('userId')->unsigned();
            $table->bigInteger('screeningId')->unsigned();
            
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('screeningId')->references('id')->on('screenings')->onDelete('cascade');
            $table->index('userId');
            $table->index('screeningId');
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
        Schema::dropIfExists('reservation');
    }
}
