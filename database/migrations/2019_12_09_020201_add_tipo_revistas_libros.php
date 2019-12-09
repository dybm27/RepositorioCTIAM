<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoRevistasLibros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('libros', function(Blueprint $table) {
            $table->string('tipo')->after('descripcion');
        });
        Schema::table('revistas', function(Blueprint $table) {
            $table->string('tipo')->after('descripcion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('libros', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
        Schema::table('revistas', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
}
