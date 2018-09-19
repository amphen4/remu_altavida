<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dscto;
use Illuminate\Http\Response;
class AdminDescuentosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    public function store(Request $request)
    {
    	$request->validate([
            'nombre' => 'required|string|max:190',
            'tipo' => 'required|in:MONTO,PORCENTAJE SUELDO BASE,UF,UTM',
            //'factor' => 'required|in:NINGUNO,MONTO,PORCENTAJE SUELDO BASE,UF,UTM',
            'valor' => 'required',
            'imponible' => 'required|in:false,true'
        ]);
    	$nuevo = new Dscto();
    	$nuevo->nombre = $request->nombre;
    	$nuevo->tipo = $request->tipo;
    	$nuevo->factor = "NINGUNO"; 
    	switch($request->tipo){
    		case 'MONTO':
                $nuevo->valor_entero = intval(str_replace('.','',$request->valor));
                break;
            case 'UF':
                $nuevo->valor_entero = intval(str_replace('.','',$request->valor));
                break;
            case 'UTM':
                $nuevo->valor_entero = intval(str_replace('.','',$request->valor));
                break;
            case 'PORCENTAJE SUELDO BASE':
                $nuevo->valor_porcentaje = floatval(str_replace(',','.',$request->valor));
                break;
    	}

    	switch ($request->imponible){
    		case 'false':
    			$nuevo->imponible = false;
    			break;
    		case 'true':
    			$nuevo->imponible = true;
    			break;
    	}

    	$nuevo->save();

    	return new Response(200);
    }
    public function data()
    {
    	$asi['data'] = Dscto::all()->toArray();
        return json_encode($asi);
    }
}
