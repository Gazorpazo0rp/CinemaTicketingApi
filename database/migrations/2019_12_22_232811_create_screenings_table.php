<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScreeningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screenings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('movieId')->unsigned();
            $table->bigInteger('screenId')->unsigned();
            $table->string('setting');
            $table->timestamps();

            $table->foreign('movieId')->references('id')->on('movies')->onDelete('cascade');
            $table->foreign('screenId')->references('id')->on('screen')->onDelete('cascade');
            $table->index('movieId');
            $table->index('screenId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('screenings');
    }
}
