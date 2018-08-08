<?php

use Illuminate\Database\Seeder;
use App\Afp;

class AfpsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nuevo = new Afp();
        $nuevo->nombre = 'Modelo' ;
        $nuevo->porcentaje = 11.3 ;
        $nuevo->save();

        $nuevo = new Afp();
        $nuevo->nombre = 'Cuprum' ;
        $nuevo->porcentaje = 13.5 ;
        $nuevo->save();
    }
}
