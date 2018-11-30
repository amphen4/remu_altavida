<?php

use Illuminate\Database\Seeder;
use App\Isapre;

class IsapresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nuevo = new Isapre();
        $nuevo->nombre = 'FONASA' ;
        //$nuevo->porcentaje = 7.8 ;
        $nuevo->save(); 
        
        $nuevo = new Isapre();
        $nuevo->nombre = 'Banmedica' ;
        //$nuevo->porcentaje = 8.9 ;
        $nuevo->save();

        $nuevo = new Isapre();
        $nuevo->nombre = 'Consalud' ;
        //$nuevo->porcentaje = 7.8 ;
        $nuevo->save();

        
    }
}
