<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHabersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->enum('tipo',['valor','porcentaje']);
            $table->unsignedDecimal('valor_porcentaje',5,3)->nullable();
            $table->unsignedInteger('valor_entero')->nullable();
            $table->enum('factor',['sueldo_base','uf','utm'])->nullable(); // ir agregando mas
            $table->boolean('imponible');
            
        });
        // Tabla relacion Muchos a Muchos
        Schema::create('contrato_haber', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contrato_id')->unsigned();
            $table->foreign('contrato_id')->references('id')->on('contratos')->onDelete('restrict');
            $table->integer('haber_id')->unsigned();
            $table->foreign('haber_id')->references('id')->on('habers')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('habers');
    }
}
