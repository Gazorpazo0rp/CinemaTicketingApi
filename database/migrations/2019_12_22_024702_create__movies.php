<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('genre');
            $table->integer('length');
            $table->string('imagepath')->nullable();
            $table->timestamps();
        });
        DB::table('movies')->insert(
            array(
                'name'      =>  'Inglorious Bastards'  ,  
                'imagepath' =>  'Inglorious Bastards.jpg',
                'length'    =>  130,
                'genre'     =>  'Drama'
            )
        );
        DB::table('movies')->insert(
            array(
                'name'      =>  'Joker' ,
                'imagepath' =>  'Joker.jpg',
                'length'    =>  110,
                'genre'     =>  'Dark'
            )
        );
        DB::table('movies')->insert(
            array(
                'name'      =>  'The two popes' ,
                'imagepath'      =>  'The two popes.jpg',
                'length'    =>  115,
                'genre'     =>  'Drama'
            )
        );
        DB::table('movies')->insert(
            array(
                'name'      =>  'Her' ,
                'imagepath'      =>  'Her.jpg',
                'length'    =>  110,
                'genre'     =>  'Romance'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_movies');
    }
}
