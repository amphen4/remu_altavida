<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rut');
            $table->string('nombre');
            $table->string('apellido_pat');
            $table->string('apellido_mat');
            $table->string('direccion');
            $table->string('comuna');
            $table->string('ciudad');
            $table->string('telefono');
            $table->string('celular');
            $table->string('email');
            $table->enum('sexo',['masculino','femenino']);
            $table->enum('estado_civil',['Soltero(a)','Casado(a)','Viudo(a)']);
            $table->date('fecha_nacimiento');
            $table->string('cargo');
            $table->string('titulo');
            $table->string('pais');

            $table->string('cta_banco_nombre')->nullable();
            $table->string('cta_banco_nro')->nullable();
            $table->string('cta_banco_tipo')->nullable();

            $table->date('fecha_ingreso');
            $table->date('fecha_retiro')->nullable();
            $table->date('fecha_renovacion')->nullable();
            // ==================
            // Llaves Foraneas  
            // ==================
            $table->integer('empresa_id')->unsigned();
            $table->foreign('empresa_id')
                  ->references('id')->on('empresas')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->integer('afp_id')->unsigned()->nullable();
            $table->foreign('afp_id')
                  ->references('id')->on('afps')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->integer('isapre_id')->unsigned()->nullable();
            $table->foreign('isapre_id')
                  ->references('id')->on('isapres')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
