<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('client_id');
            $table->bigInteger('patient_id')->unsigned();

            $table->foreign('client_id')->references('id')->on('users');
            $table->foreign('patient_id')->references('id')->on('patients');

            
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
        Schema::dropIfExists('client_patients');
    }
}
