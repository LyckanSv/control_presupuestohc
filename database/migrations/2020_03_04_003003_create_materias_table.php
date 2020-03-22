<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materias', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('codigo');
            $table->string('nombre');
            $table->integer('unidad_valorativa');
            $table->unsignedBigInteger('facultad_id');
            $table->unsignedBigInteger('escuela_id');
            $table->foreign('facultad_id')->references('id')->on('facultads');
            $table->foreign('escuela_id')->references('id')->on('escuelas');
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
        Schema::dropIfExists('materias');
    }
}
