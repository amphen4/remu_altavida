<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sueldo_base');
            $table->unsignedInteger('valor_colacion');
            $table->unsignedInteger('valor_movilizacion');
            $table->unsignedInteger('valor_hora_extra');
            $table->unsignedInteger('valor_hora_atraso');
            $table->unsignedTinyInteger('horas_semanales');
            $table->unsignedTinyInteger('dias_semanales')->default(5);
            //$table->unsignedTinyInteger();
            
        });
        // Tabla relacion Muchos a Muchos
        Schema::create('empleado_contrato', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empleado_id')->unsigned();
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('restrict');
            $table->integer('contrato_id')->unsigned();
            $table->foreign('contrato_id')->references('id')->on('contratos')->onDelete('restrict');
            // Atributos extras
            $table->enum('estado',['ACTIVO','INACTIVO']);
            $table->date('fecha_inicio');
            $table->enum('tipo',['DEFINIDO','INDEFINIDO']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contratos');
    }
}
