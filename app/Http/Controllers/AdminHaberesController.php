<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Haber;
use Illuminate\Http\Response;
class AdminHaberesController extends Controller
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
            'tipo' => 'required|in:MONTO,PORCENTAJE',
            'factor' => 'required|in:NINGUNO,SUELDO BASE,UF,UTM',
            'valor' => 'required',
            'imponible' => 'required|in:false,true'
        ]);
    	$nuevo = new Haber();
    	$nuevo->nombre = $request->nombre;
    	$nuevo->tipo = $request->tipo;
    	if($request->factor !== 'NINGUNO') { $nuevo->factor = $request->factor; }
    	switch($request->tipo){
    		case 'MONTO':
    			$nuevo->valor_entero = intval(str_replace('.','',$request->valor));
    			break;
    		case 'PORCENTAJE':
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
    	$asi['data'] = Haber::all()->toArray();
        return json_encode($asi);
    }
}
