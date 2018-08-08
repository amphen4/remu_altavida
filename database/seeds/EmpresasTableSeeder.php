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
        $empresa->direccion = 'Calle #numero';
        $empresa->comuna = 'Viña del mar';
        $empresa->ciudad = 'Viña del mar';
        $empresa->region = 'Region de Valparaíso';
        $empresa->telefono = '32 2505050';
        $empresa->rubro = 'Educacion';
        $empresa->email = 'correo@altavida.cl';
        $empresa->paginaweb = 'www.paginaweb.cl';
        $empresa->representante_nombre = 'Juan Perez';
        $empresa->representante_rut = '12123123-1';
        $empresa->contador_nombre = 'Juan Contador';
        $empresa->contador_rut = '11133344-5';
        $empresa->save();
    }
}
