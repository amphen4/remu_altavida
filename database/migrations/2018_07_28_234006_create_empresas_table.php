<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rut');
            $table->string('nombre');
            $table->string('direccion')->nullable();
            $table->string('comuna')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('region')->nullable();
            $table->string('telefono')->nullable();
            $table->string('rubro')->nullable();
            $table->string('email')->nullable();
            $table->string('codigo')->nullable();
            $table->string('paginaweb')->nullable();

            $table->string('representante_nombre')->nullable();
            $table->string('representante_rut')->nullable();
            $table->string('contador_nombre')->nullable();
            $table->string('contador_rut')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
