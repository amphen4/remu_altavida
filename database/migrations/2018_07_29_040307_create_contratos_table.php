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
            $table->unsignedInteger('valor_hora_extra')->nullable(); // SON NULLAbLE PORQUE FALTA IMPLEMENTARLO EN EL CREAR CONTRATO
            $table->unsignedInteger('valor_hora_atraso')->nullable(); // SON NULLAbLE PORQUE FALTA IMPLEMENTARLO EN EL CREAR CONTRATO
            $table->unsignedTinyInteger('horas_semanales')->nullable(); // SON NULLAbLE PORQUE FALTA IMPLEMENTARLO EN EL CREAR CONTRATO
            $table->unsignedTinyInteger('dias_semanales')->default(5); // SON NULLAbLE PORQUE FALTA IMPLEMENTARLO EN EL CREAR CONTRATO
            $table->enum('estado',['ACTIVO','INACTIVO']);
            $table->date('fecha_inicio');
            $table->enum('tipo',['DEFINIDO','INDEFINIDO']);
            //$table->unsignedTinyInteger();

            // Llaves Foraneas
            $table->integer('empleado_id')->unsigned();
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('restrict');
            
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
