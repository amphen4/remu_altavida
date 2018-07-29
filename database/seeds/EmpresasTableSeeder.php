<?php

use Illuminate\Database\Seeder;
use App\Empresa;
class EmpresasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $empresa = new Empresa();
        $empresa->nombre = 'Corporación Altavida';
        $empresa->rut = '12345678-9';
        $empresa->save();
    }
}
