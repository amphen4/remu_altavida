<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Liquidacion;
use App\Contrato;
use Carbon\Carbon;
use App\Empleado;
use App\Haber;
use App\Dscto;
class AdminLiquidacionesController extends Controller
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


    	return view('liquidaciones.indexLiquidaciones');
    }
    public function data()
    {
    	$asi['data'] = Liquidacion::all()->toArray();

        //dd($wea['data']);
        return json_encode($asi);
    }
    public function detalleProxLiquidacion(Request $request)
    {
        $contrato = Contrato::findOrFail($request->id);
        $arreglo['contrato'] = $contrato;
        $empleado = $contrato->empleado()->first();
        $arreglo['empleado'] = $empleado;
        $liquidacionesEmpleado = $empleado->liquidacions();
        if(!$liquidacionesEmpleado->count()){
            // Caso:  no hay liquidaciones, la fecha inicio de la liquidacion sera la fecha de inicio del contrato
            $arreglo['fecha_inicio'] = $contrato->fecha_inicio;
        }else{
            // Caso: si hay liquidaciones, osea hay que obtener la fecha_inicio de la prox liquidacion que sera el dia posterior a la fecha_fin de la ultima liquidacion
            $ultimaLiquidacion = $liquidacionesEmpleado->orderBy('fecha_fin', 'desc')->first();
            $fecha_inicio_proxLiquidacion = Carbon::createFromFormat('Y-m-d',$ultimaLiquidacion->fecha_fin)->addDay();
            $arreglo['fecha_inicio'] = $fecha_inicio_proxLiquidacion->toDateString();
        }
        foreach($contrato->habers()->get() as $haber){
            $arreglo['haberes'][] = $haber;
        }
        foreach($contrato->dsctos()->get() as $descuento){
            $arreglo['descuentos'][] = $descuento;
        }
        return json_encode($arreglo);
    }
    public function generarLiquidacionManual(Request $request)
    {
        $this->validate($request, [ 'idEmpleado' => 'required|string',
                                    'periodo' => 'required|string',
                                  ]);
        
        $str_inicio = substr($request->periodo, 0, 10);
        $str_fin = substr($request->periodo, 13, 23);

        $fecha_inicio = Carbon::createFromFormat('Y-m-d', $str_inicio);
        $fecha_fin = Carbon::createFromFormat('Y-m-d', $str_fin);

        $empleado = Empleado::find($request->idEmpleado);

        dd( $empleado->contratos()->get() );
        
    }
    public function mensualidadesHaberAgotadas(Request $request)
    {
        $this->validate($request, [ 'idContrato' => 'required|exists:contratos,id',
                                    'idHaber' => 'required|exists:habers,id',
                                  ]);

        $contrato = Contrato::findOrFail($request->idContrato);
        $haber = Haber::findOrFail($request->idHaber);

        $duracionHaber = 0;
        $fecha_inicio_haber = '';
        //dd( $contrato->dsctos() );
        foreach ($contrato->habers()->get() as $haber_recorrido) {

            if($haber_recorrido->id == $haber->id){
                $duracionHaber = intval( ($haber_recorrido->pivot->duracion)? $haber_recorrido->pivot->duracion : 0 );
                $fecha_inicio_haber = $haber_recorrido->pivot->fecha_inicio;
            }
        }
        if ($duracionHaber != 0 && $fecha_inicio_haber != ''){
            $fecha_fin = Carbon::createFromFormat('Y-m-d',$fecha_inicio_haber)->addMonths($duracionHaber)->subDay()->toDateString();
            return json_encode( $nro =  $contrato->liquidacions()->get()->where('fecha_inicio', '>=', $fecha_inicio_haber)->where('fecha_fin', '<=', $fecha_fin)->count() );
        }else{
            return json_encode($nro = 0);
        }
        
    }
    public function mensualidadesDsctoAgotadas(Request $request)
    {
        $this->validate($request, [ 'idContrato' => 'required|exists:contratos,id',
                                    'idDscto' => 'required|exists:dsctos,id',
                                  ]);

        $contrato = Contrato::findOrFail($request->idContrato);
        $dscto = Dscto::findOrFail($request->idDscto);

        $duracionDscto = 0;
        $fecha_inicio_dscto = '';
        //dd( $contrato->dsctos() );
        foreach ($contrato->dsctos()->get() as $dscto_recorrido) {

            if($dscto_recorrido->id == $dscto->id){
                $duracionDscto = intval( ($dscto_recorrido->pivot->duracion)? $dscto_recorrido->pivot->duracion : 0 );
                $fecha_inicio_dscto = $dscto_recorrido->pivot->fecha_inicio;
            }
        }
        if ($duracionDscto != 0 && $fecha_inicio_dscto != ''){
            $fecha_fin = Carbon::createFromFormat('Y-m-d',$fecha_inicio_dscto)->addMonths($duracionDscto)->subDay()->toDateString();
            return json_encode( $nro =  $contrato->liquidacions()->get()->where('fecha_inicio', '>=', $fecha_inicio_dscto)->where('fecha_fin', '<=', $fecha_fin)->count() );
        }else{
            return json_encode($nro = 0);
        }
    }
}
