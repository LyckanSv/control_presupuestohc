<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('materia_id');
            $table->foreign('materia_id')->references('id')->on('materias');

            $table->unsignedBigInteger('aula_id');
            $table->foreign('aula_id')->references('id')->on('aulas');

            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');

            $table->unsignedBigInteger('bloque_horas_id');
            $table->foreign('bloque_horas_id')->references('id')->on('bloque_horas');

            $table->unsignedBigInteger('estado_clase_id');
            $table->foreign('estado_clase_id')->references('id')->on('estado_class');
            
            $table->integer('codigo');
            $table->date('fecha_inicio_curso');
            $table->date('fecha_finalizacion_curso');
            $table->integer('cupo');
            $table->integer('inscritos');
            $table->string('seccion');
            $table->decimal('sueldo_hora');
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
        Schema::dropIfExists('clases');
    }
}
