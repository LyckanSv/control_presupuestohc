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
            $table->unsignedBigInteger('aula_id');
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('bloque_horas_id');
            $table->unsignedBigInteger('estado_clase_id');
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
