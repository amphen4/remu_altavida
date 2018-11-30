<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Registro;
class IngresoController extends Controller
{
    public function index()
    {
    	return view('empleados.ingreso');
    }
    public function registro(Request $request)
    {
    	$request->validate([
            'rut' => 'required|numeric',
            'pin' => 'required|numeric|min:0|max:9999',
            'tipo' => 'required|in:entrada,salida',
        ]);
        $empleados = Empleado::all();
        $e = null;
       
        foreach ($empleados as $empleado ){
        	//dd(substr($empleado->rut,0, strlen($empleado->rut)-2));
            //dd(substr($empleado->rut,0, strlen($empleado->rut)-2) == $request->rut);
            $rutBD = substr($empleado->rut,0, strlen($empleado->rut)-2);
			if( $rutBD == $request->rut ){
				$e = $empleado;
				
			}
		}
        if(!$e){
            return json_encode(['tipo' => 'error', 'mensaje' => 'El rut ingresado no existe']);// ERROR JSON, EL RUT INGRESADO NO EXISTE
        }
	    if( DB::table('empleados')->where('rut', $e->rut)->where('pin',$request->pin)->count() ){
	    	//dd(Carbon::now()->endOfDay()->toDateTimeString());
    		if( $request->tipo == 'entrada' ){
    			if( DB::table('registros')->where('empleado_id',$e->id)->where('tipo', 'ENTRADA')->where('hora','>=',Carbon::now()->startOfDay()->toDateTimeString())->where('hora', '<=', Carbon::now()->endOfDay()->toDateTimeString())->count() ){
    				return json_encode(['tipo' => 'error', 'mensaje' => 'El empleado ya registro una entrada']);
    			}else{
    				$nuevo = new Registro();
    				$nuevo->tipo = 'ENTRADA';
    				$fecha_carbon = Carbon::now();
    				$nuevo->hora = $fecha_carbon->toDateTimeString();
    				$nuevo->empleado_id = $e->id;
    				$nuevo->save();
    				return json_encode(['tipo' => 'exito', 'mensaje' => 'La entrada ha sido registrada a las '.$fecha_carbon->toDateTimeString()]);
    			}
    		}
    		if( $request->tipo == 'salida' ){
    			if( DB::table('registros')->where('empleado_id',$e->id)->where('tipo', 'SALIDA')->where('hora','>=',Carbon::now()->startOfDay()->toDateTimeString())->where('hora', '<=', Carbon::now()->endOfDay()->toDateTimeString())->count()  ){
    				return json_encode(['tipo' => 'error', 'mensaje' => 'El empleado ya registro una salida']);
    			}else{
    				if( Carbon::now()->startOfDay()->addHours(env('HORA_SALIDA'))->lessThan(Carbon::now()) ){
    					$fecha_carbon = Carbon::now()->startOfDay()->addHours(env('HORA_SALIDA'));
    				}else{
    					$fecha_carbon = Carbon::now();
    				}
    				$nuevo = new Registro();
    				$nuevo->tipo = 'SALIDA';
    				$nuevo->hora = $fecha_carbon->toDateTimeString();
    				$nuevo->empleado_id = $e->id;
    				$nuevo->save();
    				return json_encode(['tipo' => 'exito', 'mensaje' => 'La salida ha sido registrada a las '.$fecha_carbon->toDateTimeString()]);
    			}
    		}
    		 
    	}
    	
    	
    }
    public function cambiar_pin_mostrar()
    {
        return view('empleados.cambiarPin');
    }
    public function cambiar_pin_guardar(Request $request)
    {
        $request->validate([
            'rut' => 'required|numeric',
            'pin_actual' => 'required|numeric|max:9999|min:0',
            'pin_nuevo' => 'required|numeric|max:9999|min:0'
        ]);
        $empleados = Empleado::all();
        $e;
       
        foreach ($empleados as $empleado ){
            //dd(substr($empleado->rut,0, strlen($empleado->rut)-2));
            if( substr($empleado->rut,0, strlen($empleado->rut)-2) == $request->rut ){
                $e = $empleado;
                
            }else{
                return json_encode(['tipo' => 'error', 'mensaje' => 'El rut ingresado no existe']);// ERROR JSON, EL RUT INGRESADO NO EXISTE
            }
        }
        if( $e->pin != $request->pin_actual )
        {
            return json_encode((['tipo' => 'error', 'mensaje' => 'El rut con el pin actual no coinciden']));
        }
        $e->pin = $request->pin_nuevo;
        $e->save();
        return json_encode(['tipo' => 'exito', 'mensaje' => 'El Pin ha sido cambiado exitosamente, si tiene algun problema favor contactarse con un administrador']);
    }
}
