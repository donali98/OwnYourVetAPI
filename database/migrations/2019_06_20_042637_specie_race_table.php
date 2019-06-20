<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpecieRaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specie_race', function (Blueprint $table) {
            $table->bigInteger('race_id')->unsigned();
            $table->bigInteger('specie_id')->unsigned();

            $table->foreign('race_id')->references('id')->on('races');
            $table->foreign('specie_id')->references('id')->on('species');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specie_race');
    }
}
