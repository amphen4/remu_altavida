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
        //$this->middleware('role:admin');
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
                                    'descuentos' => 'required|string',
                                    'horas_semanales' => 'required|numeric',
                                    'dias_semanales' => 'required|numeric',
                                    'fecha_inicio' => 'required|date'
                                  ]);

        $haberes = json_decode($request->haberes);
        $descuentos = json_decode($request->descuentos);
        $empleado = Empleado::find($request->empleado);
        if($empleado->contratos()->where('estado', 'ACTIVO')->first()){
            $contrato = $empleado->contratos()->where('estado', 'ACTIVO')->first();
            $contrato->estado = 'INACTIVO';
            //$empleado->contrato()->first()->empleado()->dissociate();
            $contrato->save();

        }
        $sueldo_base = $request->sueldo_base;
        $contrato = new Contrato();
        $contrato->horas_semanales = json_decode($request->horas_semanales);
        $contrato->dias_semanales = json_decode($request->dias_semanales);
        $contrato->estado = 'ACTIVO';
        $contrato->tipo = 'INDEFINIDO';
        $contrato->fecha_inicio = $request->fecha_inicio;
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
    public function show($id)
    {
        $contrato = Contrato::findOrFail($id);
        return view('contratos.verContrato',[ 'contrato' => $contrato,
                                                'empresa' => Empresa::find(1),
                                                'empleado' => $contrato->empleado()->first()
                                                 ]);
    }
    public function data_l()
    {
        $asi['data'] = Contrato::where('estado','ACTIVO')->get()->toArray();
        return json_encode($asi);
    }
    public function edit($id)
    {
        $contrato = Contrato::findOrFail($id);
        $empresa = Empresa::find(1);
        return view('contratos.editarContrato', ['contrato' => $contrato, 'empresa' => $empresa]);
    }
}
