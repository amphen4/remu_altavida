<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Liquidacion;
use App\Contrato;
use Carbon\Carbon;
use App\Empleado;
use App\Haber;
use App\Dscto;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

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
    	return view('liquidaciones.indexLiquidaciones', ['proximas_liquidaciones' => Contrato::where('estado', 'ACTIVO')->get()->sortBy('fecha_inicio_proxima_liquidacion')->take(3)]);
    }
    public function data()
    {
    	$asi['data'] = Liquidacion::all()->toArray();
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
            //$arreglo['fecha_inicio'] = Carbon::createFromFormat('Y-m-d',$contrato->fecha_inicio)->addMonth()->subDay()->toDateString();
            $arreglo['fecha_inicio'] = Carbon::createFromFormat('Y-m-d',$contrato->fecha_inicio)->toDateString();
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
        $this->validate($request, [ 'idEmpleado' => 'required|exists:empleados,id',
                                    'periodo' => 'required|string',
                                    'mes' => 'required|string',
                                  ]);
        //dd($request->periodo);
        $str_inicio = substr($request->periodo, 0, 10);
        $str_fin = substr($request->periodo, 13, 23);
        //dd($str_inicio.' - '.$str_fin);
        // HORAS TRABAJADAS
        $query = DB::table('registros')->select(DB::raw('TIMESTAMPDIFF(HOUR, MIN(hora), MAX(hora) ) as horas'))->where('hora', '<=', $str_fin)->where('hora', '>=', $str_inicio)->where('empleado_id', $request->idEmpleado)->groupBy(DB::raw('DATE(hora)'))->get();
        $acumulador = 0; 
        $contador = 0;
        foreach($query as $fila){
            //dd($fila->horas);
            $contador++;
            $acumulador+= intval($fila->horas);
        }

        $fecha_inicio = Carbon::createFromFormat('Y-m-d', $str_inicio);
        $fecha_fin = Carbon::createFromFormat('Y-m-d', $str_fin);

        $empleado = Empleado::find($request->idEmpleado);

        $contrato = $empleado->contratos()->latest('fecha_inicio')->first();

        Carbon::setLocale('es');
        $fecha = Carbon::now('America/Santiago');
        $diaSemana = $fecha->format('l'); // Se busca obtener el nombre del dia en la semana, si es sabado o domingo, la api no funciona bien para esos dias.
        if($diaSemana == 'Saturday') { $fecha->subDay(); }
        if($diaSemana == 'Sunday') { $fecha->subDays(2); }
        $ano = $fecha->format('Y');
        $mes = $fecha->format('m');
        $dia = $fecha->format('d');
        $client = new Client();

        $res = $client->request('GET', 'https://api.sbif.cl/api-sbifv3/recursos_api/uf/'.$ano.'/'.$mes.'/dias/'.$dia.'?apikey=243ee93523145ebdd7f6f2d9c1a3320401bbee5d&formato=json');
        $string_uf = str_replace_first('.', '',str_replace(',','.',json_decode($res->getBody()->getContents())->UFs[0]->Valor));
        $valor_uf = intval(floatval($string_uf));

        $res = $client->request('GET', 'https://api.sbif.cl/api-sbifv3/recursos_api/utm/'.$ano.'/'.$mes.'?apikey=243ee93523145ebdd7f6f2d9c1a3320401bbee5d&formato=json');
        $string_utm = str_replace_first('.', '',str_replace(',','.',json_decode($res->getBody()->getContents())->UTMs[0]->Valor));
        $valor_utm = intval(floatval($string_utm));

        //$valor_uf= 1;
        //$valor_utm=1;
        $total_haberes = 0;
        $total_imponible= 0;
        $total_descuentos = 0;
        $total_imponible += $contrato->sueldo_base;
        $total_no_imponible = 0;
        foreach($contrato->habers()->get() as $haber){
            if( Carbon::createFromFormat('Y-m-d', $haber->pivot->fecha_inicio)->isPast() ){
                if( $haber->pivot->duracion ){
                    // aqui se esta viendo cuantas liquidaciones se han pagado con ese haber dentro de (duracion) Meses siguientes desde la fecha de inicio de ese haber. Si la cantidad es menor al valor duracion, es porque se tiene que pagar.
                    if( DB::table('liquidacions')->where('empleado_id', $empleado->id)->where('fecha_inicio', '>=', $haber->pivot->fecha_inicio)->where('fecha_inicio', '<=', Carbon::createFromFormat('Y-m-d', $haber->pivot->fecha_inicio)->addMonths($haber->pivot->duracion)->toDateString())->count() < $haber->pivot->duracion ){
                        if($haber->imponible){

                            switch ($haber->tipo) {
                                case 'MONTO':
                                    $total_imponible += $haber->valor_entero;
                                    break;
                                case 'PORCENTAJE SUELDO BASE':
                                    $total_imponible += $contrato->sueldo_base * ($haber->valor_porcentaje/100.0);
                                    break;
                                case 'UF':
                                    $total_imponible += $haber->valor_porcentaje * $valor_uf;
                                    break;
                                case 'UTM':
                                    $total_imponible += $haber->valor_porcentaje * $valor_utm;
                                    break;    
                            }
                        }else{
                            switch ($haber->tipo) {
                                case 'MONTO':
                                    $total_no_imponible += $haber->valor_entero;
                                    $total_haberes += $haber->valor_entero;
                                    break;
                                case 'PORCENTAJE SUELDO BASE':
                                    $total_no_imponible += $contrato->sueldo_base * ($haber->valor_porcentaje/100.0);
                                    $total_haberes += $contrato->sueldo_base * ($haber->valor_porcentaje/100.0);
                                    break;
                                case 'UF':
                                    $total_no_imponible += $haber->valor_porcentaje * $valor_uf;
                                    $total_haberes += $haber->valor_porcentaje * $valor_uf;
                                    break;
                                case 'UTM':
                                    $total_no_imponible += $haber->valor_porcentaje * $valor_utm;
                                    $total_haberes += $haber->valor_porcentaje * $valor_utm;
                                    break;    
                            }
                        }
                    }
                }else{
                    if($haber->imponible){

                        switch ($haber->tipo) {
                            case 'MONTO':
                                $total_imponible += $haber->valor_entero;
                                break;
                            case 'PORCENTAJE SUELDO BASE':
                                $total_imponible += $contrato->sueldo_base * ($haber->valor_porcentaje/100.0);
                                break;
                            case 'UF':
                                $total_imponible += $haber->valor_porcentaje * $valor_uf;
                                break;
                            case 'UTM':
                                $total_imponible += $haber->valor_porcentaje * $valor_utm;
                                break;    
                        }
                    }else{
                        switch ($haber->tipo) {
                            case 'MONTO':
                                $total_no_imponible += $haber->valor_entero;
                                $total_haberes += $haber->valor_entero;
                                break;
                            case 'PORCENTAJE SUELDO BASE':
                                $total_no_imponible += $contrato->sueldo_base * ($haber->valor_porcentaje/100.0);
                                $total_haberes += $contrato->sueldo_base * ($haber->valor_porcentaje/100.0);
                                break;
                            case 'UF':
                                $total_no_imponible += $haber->valor_porcentaje * $valor_uf;
                                $total_haberes += $haber->valor_porcentaje * $valor_uf;
                                break;
                            case 'UTM':
                                $total_no_imponible += $haber->valor_porcentaje * $valor_utm;
                                $total_haberes += $haber->valor_porcentaje * $valor_utm;
                                break;      
                        }
                    }
                }
                       
            }    
        }
        //dd($total_imponible);
        $total_haberes += $total_imponible;
        $descuentos_o = 0; // OJO <----------------
        foreach($contrato->dsctos()->get() as $haber){
            if( Carbon::createFromFormat('Y-m-d', $haber->pivot->fecha_inicio)->isPast() ){
                if( $haber->pivot->duracion ){
                    if( DB::table('liquidacions')->where('empleado_id', $empleado->id)->where('fecha_inicio', '>=', $haber->pivot->fecha_inicio)->where('fecha_inicio', '<=', Carbon::createFromFormat('Y-m-d', $haber->pivot->fecha_inicio)->addMonths($haber->pivot->duracion)->toDateString())->count() < $haber->pivot->duracion ){
                    
                        switch ($haber->tipo) {
                            case 'MONTO':
                                $total_descuentos += $haber->valor_entero;
                                $descuentos_o += $haber->valor_entero;
                                break;
                            case 'PORCENTAJE SUELDO BASE':
                                $total_descuentos += $contrato->sueldo_base * ($haber->valor_porcentaje/100);
                                $descuentos_o += $contrato->sueldo_base * ($haber->valor_porcentaje/100);
                                break;
                            case 'UF':
                                $total_descuentos += $haber->valor_porcentaje * $valor_uf;
                                $descuentos_o += $haber->valor_porcentaje * $valor_uf;
                                break;
                            case 'UTM':
                                $total_descuentos += $haber->valor_porcentaje * $valor_utm;
                                $descuentos_o += $haber->valor_porcentaje * $valor_utm;
                                break;    
                        }
                        
                    }
                }else{
                    switch ($haber->tipo) {
                        case 'MONTO':
                            $total_descuentos += $haber->valor_entero;
                            $descuentos_o += $haber->valor_entero;
                            break;
                        case 'PORCENTAJE SUELDO BASE':
                            $total_descuentos += $contrato->sueldo_base * ($haber->valor_porcentaje/100);
                            $descuentos_o += $contrato->sueldo_base * ($haber->valor_porcentaje/100);
                            break;
                        case 'UF':
                            $total_descuentos += $haber->valor_porcentaje * $valor_uf;
                            $descuentos_o += $haber->valor_porcentaje * $valor_uf;
                            break;
                        case 'UTM':
                            $total_descuentos += $haber->valor_porcentaje * $valor_utm;
                            $descuentos_o += $haber->valor_porcentaje * $valor_utm;
                            break;    
                    }
                } 
            }    
        }
        // calcular imeusto renta
        if($total_imponible >= env("MONTO_ULTIMO_TRAMO")){
            $impuesto_renta = intval($total_imponible*floatval(env("FACTOR_ULTIMO_TRAMO"))) - 1123091;
            $total_descuentos+= intval($total_imponible*floatval(env("FACTOR_ULTIMO_TRAMO"))) - 1123091;
        }else{
            $resultado = DB::table('rentas')->where('monto_desde', '<=', $total_imponible)
                                            ->where('monto_hasta', '>=', $total_imponible)
                                            ->latest('fecha_desde')
                                            ->first();
            $total = $total_imponible * $resultado->factor; 
            $total-= $resultado->cantidad_rebajar;
            $total_descuentos+= $total;
            $impuesto_renta = $total;
        }
        // agregando afp e isapre
        $total_descuentos+= $total_imponible * ($empleado->afp()->first()->porcentaje/100.0);
        $total_descuentos+= $total_imponible * ($empleado->isapre()->first()->porcentaje/100.0); 
        // Guardando la Liquidacion
        $nuevaLiquidacion = new Liquidacion();
        $nuevaLiquidacion->impuesto_renta = $impuesto_renta;
        if ($empleado->isapre()->first()->nombre == 'FONASA'){
            $nuevaLiquidacion->total_salud = $total_imponible * (7/100.0); 
        }else{
            $nuevaLiquidacion->total_salud = $empleado->cotizacion_pactada * $valor_uf; 
        }
        
        $nuevaLiquidacion->total_afp = $total_imponible * ($empleado->afp()->first()->porcentaje/100.0);
        $nuevaLiquidacion->total_haberes = $total_haberes;
        $nuevaLiquidacion->descuentos_o = $descuentos_o;
        $nuevaLiquidacion->total_descuentos = $total_descuentos;
        $nuevaLiquidacion->monto_liquido = $total_haberes - $total_descuentos;
        $nuevaLiquidacion->fecha_inicio = $fecha_inicio->toDateString();
        $nuevaLiquidacion->fecha_fin = $fecha_fin->toDateString();
        switch ($request->mes) {
            case 'Enero':
                $nuevaLiquidacion->mes = 1;
                break;
            case 'Febrero':
                $nuevaLiquidacion->mes = 2;
                break;
            case 'Marzo':
                $nuevaLiquidacion->mes = 3;
                break;
            case 'Abril':
                $nuevaLiquidacion->mes = 4;
                break;
            case 'Mayo':
                $nuevaLiquidacion->mes = 5;
                break;
            case 'Junio':
                $nuevaLiquidacion->mes = 6;
                break;
            case 'Julio':
                $nuevaLiquidacion->mes = 7;
                break;
            case 'Agosto':
                $nuevaLiquidacion->mes = 8;
                break;
            case 'Septiembre':
                $nuevaLiquidacion->mes = 9;
                break;
            case 'Octubre':
                $nuevaLiquidacion->mes = 10;
                break;
            case 'Noviembre':
                $nuevaLiquidacion->mes = 11;
                break;
            case 'Diciembre':
                $nuevaLiquidacion->mes = 12;
                break;
        }
        //$nuevaLiquidacion->mes = $request->mes;
        $nuevaLiquidacion->sueldo_contrato = $contrato->sueldo_base;
        $nuevaLiquidacion->total_imponible = $total_imponible;
        $nuevaLiquidacion->total_no_imponible = $total_no_imponible;
        $nuevaLiquidacion->estado = 'NO PAGADO';
        $nuevaLiquidacion->dias_trabajados = $contador ;
        $nuevaLiquidacion->horas_trabajadas = $acumulador ;
        $nuevaLiquidacion->contrato_id = $contrato->id;
        $nuevaLiquidacion->empleado_id = $empleado->id;
        $nuevaLiquidacion->nombre_afp = $empleado->afp()->first()->nombre;
        $nuevaLiquidacion->nombre_salud = $empleado->isapre()->first()->nombre;
        $nuevaLiquidacion->tasa_afp = $empleado->afp()->first()->porcentaje;
        if($empleado->afp()->first()->nombre != 'FONASA'){
            $nuevaLiquidacion->cotizacion_pactada = $empleado->cotizacion_pactada;
        }
        
        $nuevaLiquidacion->save();

        return json_encode(1);
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
    public function enviarDataLiquidacionesEmpleado($id)
    {
        $empleado = Empleado::findOrFail($id);
        $liquidaciones = $empleado->liquidacions()->orderBy('fecha_inicio', 'desc')->take(10)->get();
        return json_encode($liquidaciones);
    }
    public function enviarDataProximasLiquidaciones()
    {
        //DB::table("contratos")->select("count(empleado_id)*")->groupBy("empleado_id");
    }
    public function enviarDataGrafico()
    {
        setlocale(LC_ALL, 'es_ES');
        $inicioMes = new Carbon('first day of this month');
        for($i=0; $i<12; $i++)
        {
            $inicioMes->hour = 0;
            $inicioMes->minute = 0;
            $inicioMes->second = 0;
            $finMes = $inicioMes->copy();
            $finMes->modify('last day of this month');
            $finMes->hour = 23;
            $finMes->minute = 59;
            $finMes->second = 59;
            // Consultando montos de liquidaciones dado un periodo, de todos los empleados.
            $resultadoQuery = DB::table('liquidacions')->select(DB::raw('(SUM(total_imponible) + SUM(total_no_imponible) - SUM(descuentos_o)) as total'))->where('fecha_inicio', '>=', $inicioMes->toDateString())->where('fecha_inicio', '<=', $finMes->toDateString())->get();
            $dataObject['mes'] = ucwords($finMes->formatLocalized('%B %Y'));
            
            ($resultadoQuery) ? $dataObject['valor'] = intval($resultadoQuery->first()->total): $dataObject['valor'] = 0;
            // Consultando Horas registradas dado un periodo, de todos los empleados
            $resultadoQuery = DB::table('registros')->select(DB::raw('TIMESTAMPDIFF(HOUR, MIN(hora), MAX(hora) ) as horas'))->where('hora', '<=', $finMes->toDateString())->where('hora', '>=', $inicioMes->toDateString())->groupBy(DB::raw('DATE(hora)'))->get();
            $acumulador = 0; 
            $contador = 0;
            foreach($resultadoQuery as $fila){
                $contador++;
                $acumulador+= intval($fila->horas);
            }
            $dataObject['horas'] = $acumulador;
            $arreglo[] = $dataObject;
            $inicioMes->subMonth();
        }
        return json_encode($arreglo);
    }
    public function marcarLiquidacionPagado(Request $request)
    {
        $this->validate($request, [ 'id' => 'required|exists:liquidacions,id',
                                  ]);
        $liquidacion = Liquidacion::findOrFail($request->id);
        $liquidacion->estado = 'PAGADO';
        $liquidacion->save();

        return json_encode('OK');
    } 
}
