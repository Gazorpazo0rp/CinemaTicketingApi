<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScreenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rows');
            $table->integer('columns');
            $table->timestamps();
        });
        DB::table('screen')->insert(
            array(
                'rows'      =>  8,
                'columns'   =>  25
                
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
        Schema::dropIfExists('screen');
    }
}
