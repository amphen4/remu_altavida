<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Liquidacion;
use NumerosEnLetras;
class AnexoController extends Controller
{
    public function montoImpuestoRenta($monto_imponible)
    {
        if($monto_imponible < 0) return json_decode(0);
        if($monto_imponible >= env("MONTO_ULTIMO_TRAMO")) return json_decode(intval($monto_imponible*floatval(env("FACTOR_ULTIMO_TRAMO"))) - 1123091);
    	$resultado = DB::table('rentas')->where('monto_desde', '<=', $monto_imponible)
    									->where('monto_hasta', '>=', $monto_imponible)
    									->latest('fecha_desde')
    									->first();
    	
    	$total = $monto_imponible * $resultado->factor; 
    	$total-= $resultado->cantidad_rebajar;
    	return json_decode((intval($total)));
    }

    public function pdfPrueba()
    {
        $pdf = PDF::loadView('pdf_test', ['contrato' => 'jjjaaa']);
        return $pdf->stream('invoice.pdf');
    }
    public function pdf_liquidacion($id)
    {
        $liquidacion = Liquidacion::findOrFail($id);
        
        Carbon::setLocale('es');
        $fecha = new Carbon($liquidacion->created_at);
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

        $client = new Client();

        $res = $client->request('GET', 'https://api.sbif.cl/api-sbifv3/recursos_api/utm/'.$ano.'/'.$mes.'?apikey=243ee93523145ebdd7f6f2d9c1a3320401bbee5d&formato=json');
        $string_utm = str_replace_first('.', '',str_replace(',','.',json_decode($res->getBody()->getContents())->UTMs[0]->Valor));
        $valor_utm = intval(floatval($string_utm));
        $fecha_hoy = Carbon::now();
        $arregloHaberes['haberes'] = [];
        $arregloHaberes['agotados'] = [];
        $arregloHaberes['despues'] = [];
        $contrato = $liquidacion->contrato()->first();
        foreach($contrato->habers()->get() as $haber){
                $arregloHaberes['haberes'][] = $haber;
                $duracionHaber = intval( ($haber->pivot->duracion)? $haber->pivot->duracion : 0 );
                $fecha_inicio_haber = $haber->pivot->fecha_inicio;
                if ($duracionHaber != 0 && $fecha_inicio_haber != ''){
                    $fecha_fin = Carbon::createFromFormat('Y-m-d',$fecha_inicio_haber)->addMonths($duracionHaber)->subDay()->toDateString();
                    $arregloHaberes['agotados'][] =  $contrato->liquidacions()->get()->where('fecha_inicio', '>=', $fecha_inicio_haber)->where('fecha_fin', '<=', $fecha_fin)->count();
                }else{
                    $arregloHaberes['agotados'][] = 0;
                }
                $fecha_haber = new Carbon($haber->pivot->fecha_inicio);
                if( $fecha_hoy->gte($fecha_haber) ){
                    $arregloHaberes['despues'][] = 1;
                }else{
                    $arregloHaberes['despues'][] = 0;
                }
        }
        
        $arregloDescuentos['descuentos'] = [];
        $arregloDescuentos['agotados'] = [];
        $arregloDescuentos['despues'] = [];
        $contrato = $liquidacion->contrato()->first();
        foreach($contrato->dsctos()->get() as $haber){
                $arregloDescuentos['descuentos'][] = $haber;
                $duracionHaber = intval( ($haber->pivot->duracion)? $haber->pivot->duracion : 0 );
                $fecha_inicio_haber = $haber->pivot->fecha_inicio;
                if ($duracionHaber != 0 && $fecha_inicio_haber != ''){
                    $fecha_fin = Carbon::createFromFormat('Y-m-d',$fecha_inicio_haber)->addMonths($duracionHaber)->subDay()->toDateString();
                    $arregloDescuentos['agotados'][] =  $contrato->liquidacions()->get()->where('fecha_inicio', '>=', $fecha_inicio_haber)->where('fecha_fin', '<=', $fecha_fin)->count();
                }else{
                    $arregloDescuentos['agotados'][] = 0;
                }
                $fecha_haber = new Carbon($haber->pivot->fecha_inicio);
                if( $fecha_hoy->gte($fecha_haber) ){
                    $arregloDescuentos['despues'][] = 1;
                }else{
                    $arregloDescuentos['despues'][] = 0;
                }
        }        

        //dd($arregloHaberes);
        $pdf = PDF::loadView('liquidaciones.pdf_liquidacion', ['liquidacion' => $liquidacion, 'valor_utm' => $valor_utm, 'valor_uf' => $valor_uf, 'haberes' => $arregloHaberes, 'descuentos' => $arregloDescuentos, 'ano' => Carbon::createFromFormat('Y-m-d', $liquidacion->fecha_inicio)->format('Y'), 'monto_palabras' => NumerosEnLetras::convertir($liquidacion->monto_liquido), 'fecha' => Carbon::now()->format('d/m/Y')]);
        return $pdf->stream('Liquidacion_'.$liquidacion->id.'.pdf');
    }
    public function obtenerUF()
    {
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

        return json_encode($valor_uf);
    }
    public function obtenerUTM()
    {
        Carbon::setLocale('es');
        $fecha = Carbon::now('America/Santiago');
        $diaSemana = $fecha->format('l'); // Se busca obtener el nombre del dia en la semana, si es sabado o domingo, la api no funciona bien para esos dias.
        if($diaSemana == 'Saturday') { $fecha->subDay(); }
        if($diaSemana == 'Sunday') { $fecha->subDays(2); }
        $ano = $fecha->format('Y');
        $mes = $fecha->format('m');
        $dia = $fecha->format('d');

        $client = new Client();

        $res = $client->request('GET', 'https://api.sbif.cl/api-sbifv3/recursos_api/utm/'.$ano.'/'.$mes.'?apikey=243ee93523145ebdd7f6f2d9c1a3320401bbee5d&formato=json');
        $string_utm = str_replace_first('.', '',str_replace(',','.',json_decode($res->getBody()->getContents())->UTMs[0]->Valor));
        $valor_utm = intval(floatval($string_utm));

        return json_encode($valor_utm);
    }
}
