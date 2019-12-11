<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVistasDescargasLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vistas_descargas_libros', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_libro');
            $table->string('tipo_accion');
            $table->string('tipo_archivo');
            $table->timestamps();

            $table->foreign('id_libro')->references('id')->on('libros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vistas_descargas_libros');
    }
}
