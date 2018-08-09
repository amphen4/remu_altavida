<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Empleado;
use App\Contrato;
use App\Haber;
use App\Dscto;
use Carbon\Carbon;
class AdminContratosController extends Controller
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
    	return view('contratos.indexContratos');
    }
    public function create()
    {
    	$empresa = Empresa::find(1);
    	return view('contratos.crearContratos',['empresa' => $empresa]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [ 'empleado' => 'required|exists:empleados,id',
                                    'sueldo_base' => 'required|numeric',
                                    'haberes' => 'required|string',
                                    'descuentos' => 'required|string'
                                  ]);
        $haberes = json_decode($request->haberes);
        $descuentos = json_decode($request->descuentos);
        $empleado = Empleado::find($request->empleado);
        $sueldo_base = $request->sueldo_base;
        $contrato = new Contrato();

        $contrato->estado = 'ACTIVO';
        $contrato->tipo = 'INDEFINIDO';
        $contrato->fecha_inicio = Carbon::now()->format('Y-m-d');
        $contrato->sueldo_base = $sueldo_base;
        $contrato->empleado()->associate($empleado);
        $contrato->save();

        foreach($haberes as $haber){
            $nuevo = Haber::find($haber->id);
            if($haber->duracion == -1){
                $contrato->habers()->attach($nuevo, ['fecha_inicio' => $haber->fecha]);
            }else{
                $contrato->habers()->attach($nuevo, ['fecha_inicio' => $haber->fecha, 'duracion' => $haber->duracion]);
            }
        }

        foreach($descuentos as $descuento){
            $nuevo = Dscto::find($descuento->id);
            if($descuento->duracion == -1){
                $contrato->dsctos()->attach($nuevo, ['fecha_inicio' => $descuento->fecha]);
            }else{
                $contrato->dsctos()->attach($nuevo, ['fecha_inicio' => $descuento->fecha, 'duracion' => $descuento->duracion]);
            }
        }
        
        return response(200);
    }
    public function data()
    {
        $asi['data'] = Contrato::all()->toArray();
        return json_encode($asi);
    }
}
