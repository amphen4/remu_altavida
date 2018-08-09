<?php

use Illuminate\Database\Seeder;
use App\Empleado;
class EmpleadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $empleado = new Empleado();
        $empleado->rut = '19150812-2';
        $empleado->nombre = 'Juanito';
        $empleado->apellido_pat = 'Vidal';
        $empleado->apellido_mat = 'Sanchez';
        $empleado->direccion = 'Calle Hola #123';
        $empleado->comuna = 'La Cruz';
        $empleado->ciudad = 'La Cruz';
        $empleado->telefono = '12 345678';
        $empleado->celular = '569 12345678';
        $empleado->email = 'el.pollo.x@gmail.com';
        $empleado->sexo = 'masculino';
        $empleado->estado_civil = 'Soltero(a)';
        $empleado->fecha_nacimiento = '1995-06-04';
        $empleado->cargo = 'Trabajador a Honorarios';
        $empleado->titulo = 'Ingeniero de Ejecucion en Informatica';
        $empleado->pais = 'Chile';
        $empleado->fecha_ingreso = '2018-07-27';

        $empleado->cta_banco_nombre = 'Banco de Chile';
        $empleado->cta_banco_tipo = 'Cuenta Corriente';
        $empleado->cta_banco_nro = '2134 234234 2342';

        $empleado->empresa_id = 1;
        
        $empleado->isapre_id = 1;
        $empleado->afp_id = 1;

        $empleado->save();
    }
}
