<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Empleado;

class AdminEmpleadosController extends Controller
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

    public function index()
    {


    	return view('empleados.index');
    }

    public function enviarLista()
    {
    	
    	return Empleado::all()->toJson();
    }
    public function create(Request $request)
    {
    	//dd($request);
        $this->validate($request, [ 'rut' => 'required|string|max:10',
        						    'nombre' => 'required|string',
        						    'apellido_pat' => 'required|string',
        						    'apellido_mat' => 'required|string',
        						    'direccion' => 'required|string',
        						    'comuna' => 'required|string',
        						    'ciudad' => 'required|string',
                                    'email' => 'required|string|email|max:100',
                                    'telefono' => 'required|string', 
                                    'celular' => 'required|string',
                                    'sexo' => 'required|string',
                                    'estado_civil' => 'required|string',
                                    'fecha_nacimiento' => 'required|string',
                                    'cargo' => 'required|string',
                                    'titulo' => 'required|string',
                                    'pais' => 'required|string',
                                    'nombre_banco' => 'nullable|string',
                                    'tipo_cuenta' => 'nullable|string',
                                    'nro_cuenta' => 'nullable|string',
                                    'fecha_ingreso' => 'required|date',
                                    'fecha_retiro' => 'nullable|date',
                                    'fecha_renovacion' => 'nullable|date',
                                  ]);
        $nuevo = new Empleado();
        $nuevo->rut = $request->rut ;
        $nuevo->nombre = $request->nombre ;
        $nuevo->apellido_pat = $request->apellido_pat ;
        $nuevo->apellido_mat = $request->apellido_mat ;
        $nuevo->direccion = $request->direccion ;
        $nuevo->comuna = $request->comuna ;
        $nuevo->ciudad = $request->ciudad ;
        $nuevo->email = $request->email ;
        $nuevo->telefono = $request->telefono ;
        $nuevo->celular = $request->celular ;
        $nuevo->sexo = $request->sexo ;
        $nuevo->estado_civil = $request->estado_civil ;
        $nuevo->fecha_nacimiento = $request->fecha_nacimiento ;
        $nuevo->cargo = $request->cargo ;
        $nuevo->titulo = $request->titulo ;
        $nuevo->pais = $request->pais ;
        if(!empty($request->nombre_banco)) { $nuevo->cta_banco_nombre = $request->nombre_banco; }
        if(!empty($request->tipo_cuenta)) { $nuevo->cta_banco_tipo = $request->tipo_cuenta; }
        if(!empty($request->nro_cuenta)) { $nuevo->cta_banco_nro = $request->nro_cuenta; }
        $nuevo->fecha_ingreso = $request->fecha_ingreso ;
        if(!empty($request->fecha_retiro)) { $nuevo->fecha_retiro = $request->fecha_retiro; }
        if(!empty($request->fecha_renovacion)) { $nuevo->fecha_renovacion = $request->fecha_renovacion; }
        $nuevo->empresa_id = 1;
        $nuevo->save();
        return redirect()->route('empleados.index')->with('exito','El empleado ha sido agregado con exito!');
    }
}
