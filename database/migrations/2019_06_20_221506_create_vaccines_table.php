<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVaccinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('information',1000);
            $table->bigInteger('specie_id')->unsigned();
            $table->string('estimated_date');
            $table->integer('weeks')->unsigned();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('vaccines');
    }
}
