<?php

use Illuminate\Database\Seeder;
use App\Registro;
use App\Empleado;
class RegistrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nuevo = new Registro();
        $nuevo->tipo = 'ENTRADA';
        $nuevo->hora = '2018-08-01 08:00:00';
        $nuevo->empleado()->associate(Empleado::where('id',1)->first());
        $nuevo->save();

        $nuevo = new Registro();
        $nuevo->tipo = 'SALIDA';
        $nuevo->hora = '2018-08-01 18:00:00';
        $nuevo->empleado()->associate(Empleado::where('id',1)->first());
        $nuevo->save();
    }
}
