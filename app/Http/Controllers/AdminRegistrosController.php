<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Registro;
use App\Empleado;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;
//use Carbon\CarbonPeriod;
class AdminRegistrosController extends Controller
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
    	return view('registros.indexRegistros');
    }
    public function data()
    {
    	$wea['data'] = Registro::all()->toArray();
        return json_encode($wea);

        //return User::all()->toJson('data');
    }
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:ENTRADA,SALIDA',
            'empleado' => 'required|exists:empleados,id',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i'
        ]);
        $empleado = Empleado::find($request->empleado);
        $nuevo = new Registro();
        $nuevo->tipo = $request->tipo;
        $nuevo->hora = $request->fecha.' '.$request->hora;
        $nuevo->empleado()->associate($empleado);
        $nuevo->save();
        return redirect()->route('registros.index')->with('exito','Se ha dejado registro con éxito :'.$request->tipo.' con fecha: '.$request->fecha.' a las '.$request->hora.' hrs.');
    }
    public function enviarDataRegistrosEmpleado($id)
    {

        $empleado = Empleado::findOrFail($id);
        $registros = $empleado->registros()->orderBy('hora', 'desc')->take(10)->get();
        $wea['data'] = $registros;
        return json_encode($registros);
    }
    public function enviarDataHorasTrabajadas(Request $request)
    {
        $request->validate([
            'idEmpleado' => 'required|exists:empleados,id',
            'inicio' => 'required|date',
            'fin' => 'required|date',
        ]);
        
        $query = DB::table('registros')->select(DB::raw('TIMESTAMPDIFF(HOUR, MIN(hora), MAX(hora) ) as horas'))->where('hora', '<=', $request->fin)->where('hora', '>=', $request->inicio)->where('empleado_id', $request->idEmpleado)->groupBy(DB::raw('DATE(hora)'))->get();
        $acumulador = 0; 
        foreach($query as $fila){
            //dd($fila->horas);
            $acumulador+= intval($fila->horas);
        }
        return json_encode($acumulador);
        
    }
    public function libro_asistencias_pdf($idEmpleado, $desde, $hasta)
    {
        $desdeCarbon = new Carbon($desde);
        $hastaCarbon = new Carbon($hasta);
        $empleado = Empleado::findOrFail($idEmpleado);
        $arreglo = array();
        while( $desdeCarbon->lte($hasta) ){
            $objeto['entrada'] = null;
            $objeto['salida'] = null;
            $query = DB::table('registros')->select('*')->where(DB::raw('DATE(hora)'), $desdeCarbon->toDateString())->where('tipo', 'ENTRADA')->get();
            if(!$query->isEmpty()){
                $entrada = $query;
                $objeto['entrada'] = $entrada->first();
            }
            $query = DB::table('registros')->select('*')->where(DB::raw('DATE(hora)'), $desdeCarbon->toDateString())->where('tipo', 'SALIDA')->get();
            if(!$query->isEmpty()){
                $salida = $query;
                $objeto['salida'] = $salida->first();
            }
            if( $objeto['entrada'] || $objeto['salida'] ){
                $arreglo[] = $objeto;
            }
            $desdeCarbon->addDay();
        }
        $pdf = PDF::loadView('registros.libro_asistencias_pdf', ['asistencias' => $arreglo, 'empleado' => $empleado, 'desde' => $desde, 'hasta' => $hasta]);
        return $pdf->stream('Registro de Asistencias '.$desde.' - '.$hasta.' '.$empleado->nombre.' '.$empleado->apellido_pat.' '.$empleado->apellido_mat.'.pdf');
    }
}
