<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiquidacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidacions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('total_haberes');
            $table->unsignedInteger('total_descuentos');
            $table->unsignedInteger('monto_liquido');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->unsignedTinyInteger('mes');
            $table->unsignedInteger('sueldo_contrato');
            //$table->unsignedInteger('monto_bruto');
            $table->unsignedInteger('total_imponible');
            //$table->unsignedTinyInteger('tasa_impuesto');
            $table->enum('estado',['PAGADO','NO PAGADO']);
            //$table->unsignedInteger('afecto_impuesto');
            $table->unsignedTinyInteger('dias_trabajados');
            $table->unsignedTinyInteger('horas_trabajadas');
            $table->unsignedInteger('total_no_imponible');
            $table->unsignedInteger('descuentos_o');
            $table->unsignedInteger('total_salud');
            $table->unsignedInteger('total_afp');
            $table->unsignedInteger('impuesto_renta');
            $table->string('nombre_afp');
            $table->string('nombre_salud');
            $table->unsignedDecimal('tasa_afp', 4 ,2);
            $table->unsignedDecimal('cotizacion_pactada', 5, 3)->nullable();
            $table->timestamps();
            //$table->unsignedTinyInteger('horas_extras');

            // ==================
            // Llaves Foraneas  
            // ==================
            $table->integer('contrato_id')->unsigned();
            $table->foreign('contrato_id')
                  ->references('id')->on('contratos')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->integer('empleado_id')->unsigned();
            $table->foreign('empleado_id')
                  ->references('id')->on('empleados')
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
        Schema::dropIfExists('liquidacions');
    }
}
