<?php

use Illuminate\Database\Seeder;
use App\Renta;
class RentasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nuevo = new Renta();
        $nuevo->fecha_desde = '2018-01-01';
        $nuevo->monto_desde = 0;
        $nuevo->monto_hasta = 650160;
        $nuevo->factor = 0.000;
        $nuevo->cantidad_rebajar = 0;
        $nuevo->save();

        $nuevo = new Renta();
        $nuevo->fecha_desde = '2018-01-01';
        $nuevo->monto_desde = 650161;
        $nuevo->monto_hasta = 1444800;
        $nuevo->factor = 0.040;
        $nuevo->cantidad_rebajar = 26006;
        $nuevo->save();

        $nuevo = new Renta();
        $nuevo->fecha_desde = '2018-01-01';
        $nuevo->monto_desde = 1444801;
        $nuevo->monto_hasta = 2408000;
        $nuevo->factor = 0.080;
        $nuevo->cantidad_rebajar = 83798;
        $nuevo->save();

        $nuevo = new Renta();
        $nuevo->fecha_desde = '2018-01-01';
        $nuevo->monto_desde = 2408001;
        $nuevo->monto_hasta = 3371200;
        $nuevo->factor = 0.135;
        $nuevo->cantidad_rebajar = 216238;
        $nuevo->save();

        $nuevo = new Renta();
        $nuevo->fecha_desde = '2018-01-01';
        $nuevo->monto_desde = 3371201;
        $nuevo->monto_hasta = 4334400;
        $nuevo->factor = 0.230;
        $nuevo->cantidad_rebajar = 536502;
        $nuevo->save();

        $nuevo = new Renta();
        $nuevo->fecha_desde = '2018-01-01';
        $nuevo->monto_desde = 4334401;
        $nuevo->monto_hasta = 5779200;
        $nuevo->factor = 0.304;
        $nuevo->cantidad_rebajar = 857248;
        $nuevo->save();
    }
}
