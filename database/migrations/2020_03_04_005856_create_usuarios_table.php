<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
                 
            $table->timestamps();
                      
            $table->integer('codigo');      
            $table->unsignedBigInteger('tipo_usuario_id');     
            $table->unsignedBigInteger('facultad_id');     
            $table->string('nombre');    
            $table->string('apellido');
            $table->string('email');      
            $table->('password');
            $table->('telefono');
            $table->('dui');
            $table->('direccion');
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
        Schema::dropIfExists('usuarios');
    }
}
