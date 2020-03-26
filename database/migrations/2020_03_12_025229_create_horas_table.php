<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('materia_id');
            $table->unsignedInteger('docente_id');
            $table->string('seccion');
            $table->string('hora');
            $table->string('dias');
            $table->string('cupo');
            $table->string('inscritos');
            $table->string('disponible');
            $table->string('aula');
            $table->enum('estado',['Impartidad', 'No Impartida', 'Cancelada', 'Sin Clase']);
            $table->timestamps();

            $table->foreign('materia_id')->references('id')->on('materias')->onDelete('cascade');
            $table->foreign('docente_id')->references('id')->on(config('admin.database.users_table'))->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horas');
    }
}
