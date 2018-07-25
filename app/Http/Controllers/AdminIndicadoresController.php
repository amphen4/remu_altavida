<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Indicador;
use GuzzleHttp\Client;
use Carbon\Carbon;
class AdminIndicadoresController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Carbon::setLocale('es');
        $fecha = Carbon::now('America/Santiago');
        $ano = $fecha->format('Y');
        $mes = $fecha->format('m');
        $dia = $fecha->format('d');

        $client = new Client();
        
        $res = $client->request('GET', 'https://api.sbif.cl/api-sbifv3/recursos_api/dolar/'.$ano.'/'.$mes.'/dias/'.$dia.'?apikey=243ee93523145ebdd7f6f2d9c1a3320401bbee5d&formato=json');
        $string_dolar = str_replace(',','.',json_decode($res->getBody()->getContents())->Dolares[0]->Valor);
        $valor_dolar= floatval($string_dolar);

        $res = $client->request('GET', 'https://api.sbif.cl/api-sbifv3/recursos_api/euro/'.$ano.'/'.$mes.'/dias/'.$dia.'?apikey=243ee93523145ebdd7f6f2d9c1a3320401bbee5d&formato=json');
        $string_euro = str_replace(',','.',json_decode($res->getBody()->getContents())->Euros[0]->Valor);
        $valor_euro = floatval($string_euro);

        $res = $client->request('GET', 'https://api.sbif.cl/api-sbifv3/recursos_api/uf/'.$ano.'/'.$mes.'/dias/'.$dia.'?apikey=243ee93523145ebdd7f6f2d9c1a3320401bbee5d&formato=json');
        $string_uf = str_replace(',','.',json_decode($res->getBody()->getContents())->UFs[0]->Valor);
        $valor_uf = floatval($string_uf);

        $mes_formateada = $dia.'-'.$mes;
        $fecha_formateada = $mes_formateada.'-'.$dia;
        
        $res = $client->request('GET', 'https://api.sbif.cl/api-sbifv3/recursos_api/utm/'.$ano.'/'.$mes.'?apikey=243ee93523145ebdd7f6f2d9c1a3320401bbee5d&formato=json');
        $string_utm = str_replace(',','.',json_decode($res->getBody()->getContents())->UTMs[0]->Valor);
        $valor_utm = floatval($string_utm);

        $fecha_menos_un_mes = $fecha->copy()->subMonth();
        $ano = $fecha_menos_un_mes->format('Y');
        $mes = $fecha_menos_un_mes->format('m');
        $dia = $fecha_menos_un_mes->format('d');
        $res = $client->request('GET', 'https://api.sbif.cl/api-sbifv3/recursos_api/ipc/'.$ano.'/'.$mes.'?apikey=243ee93523145ebdd7f6f2d9c1a3320401bbee5d&formato=json');
        $string_ipc = str_replace(',','.',json_decode($res->getBody()->getContents())->IPCs[0]->Valor);
        $valor_ipc = floatval($string_ipc);
    	//$data['data'] = Indicador::all();
    	//dd( $data->toJson() );
        setlocale(LC_TIME, 'Spanish');
        return view('indicadores.inicio',['dolar' => str_replace('.',',',$valor_dolar), 'uf' => $valor_uf, 'utm' => $valor_utm, 'euro' => str_replace('.',',',$valor_euro), 'ipc' => str_replace('.',',',$valor_ipc), 'mes_ipc' => $fecha_menos_un_mes->formatLocalized('%B'), 'fecha' => $fecha_formateada, 'mes' => $mes_formateada ]);
    }
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function enviarData(Request $request)
    {
    	return response()->json(['data' => Indicador::all()] );
    }
    public function graficoUf()
    {
        $client = new Client();
        $fecha = Carbon::now('America/Santiago');
        $fecha->subMonth();
        $arreglo_meses = array();
        $arreglo_promedios = array();
        for($i = 0; $i < 12; $i++)
        {

            $ano = $fecha->format('Y');
            $mes = $fecha->format('m');
            setlocale(LC_TIME, 'Spanish');
            array_unshift($arreglo_meses,$fecha->formatLocalized('%B %Y'));
            $res = $client->request('GET', 'https://api.sbif.cl/api-sbifv3/recursos_api/uf/'.$ano.'/'.$mes.'?apikey=243ee93523145ebdd7f6f2d9c1a3320401bbee5d&formato=json');
            $acum = 0;
            $cont = 0;
            foreach( json_decode($res->getBody()->getContents())->UFs as $uf){
                $cont++;
                $acum+= floatval(str_replace_first(".","",str_replace(",",".",$uf->Valor)));
            }
            array_unshift($arreglo_promedios,round($acum/$cont,2));
            $fecha->subMonth();
        }
        return response()->json(['data' => $arreglo_promedios, 'meses' => $arreglo_meses]);
    }
    public function graficoDolar()
    {
        $client = new Client();
        $fecha = Carbon::now('America/Santiago');
        $fecha->subMonth();
        $arreglo_meses = array();
        $arreglo_promedios = array();
        for($i = 0; $i < 12; $i++)
        {

            $ano = $fecha->format('Y');
            $mes = $fecha->format('m');
            setlocale(LC_TIME, 'Spanish');
            array_unshift($arreglo_meses,$fecha->formatLocalized('%B %Y'));
            $res = $client->request('GET', 'https://api.sbif.cl/api-sbifv3/recursos_api/dolar/'.$ano.'/'.$mes.'?apikey=243ee93523145ebdd7f6f2d9c1a3320401bbee5d&formato=json');
            $acum = 0;
            $cont = 0;
            foreach( json_decode($res->getBody()->getContents())->Dolares as $dolar){
                $cont++;
                $acum+= floatval(str_replace(",",".",$dolar->Valor));
            }
            array_unshift($arreglo_promedios,round($acum/$cont,2));
            $fecha->subMonth();
        }
        return response()->json(['data' => $arreglo_promedios, 'meses' => $arreglo_meses]);
    }
    public function graficoUtm()
    {
        $client = new Client();
        $fecha = Carbon::now('America/Santiago');
        $fecha->subMonth();
        $arreglo_meses = array();
        $arreglo_promedios = array();
        for($i = 0; $i < 12; $i++)
        {

            $ano = $fecha->format('Y');
            $mes = $fecha->format('m');
            setlocale(LC_TIME, 'Spanish');
            array_unshift($arreglo_meses,$fecha->formatLocalized('%B %Y'));
            $res = $client->request('GET', 'https://api.sbif.cl/api-sbifv3/recursos_api/utm/'.$ano.'/'.$mes.'?apikey=243ee93523145ebdd7f6f2d9c1a3320401bbee5d&formato=json');
            $acum = 0;
            $cont = 0;
            foreach( json_decode($res->getBody()->getContents())->UTMs as $utm){
                $cont++;
                $acum+= floatval(str_replace_first(".","",str_replace(",",".",$utm->Valor)));
            }
            array_unshift($arreglo_promedios,round($acum/$cont,2));
            $fecha->subMonth();
        }
        return response()->json(['data' => $arreglo_promedios, 'meses' => $arreglo_meses]);
    }
    public function graficoIpc()
    {
        $client = new Client();
        $fecha = Carbon::now('America/Santiago');
        $fecha->subMonth();
        $arreglo_meses = array();
        $arreglo_promedios = array();
        for($i = 0; $i < 12; $i++)
        {

            $ano = $fecha->format('Y');
            $mes = $fecha->format('m');
            setlocale(LC_TIME, 'Spanish');
            array_unshift($arreglo_meses,$fecha->formatLocalized('%B %Y'));
            $res = $client->request('GET', 'https://api.sbif.cl/api-sbifv3/recursos_api/ipc/'.$ano.'/'.$mes.'?apikey=243ee93523145ebdd7f6f2d9c1a3320401bbee5d&formato=json');
            $acum = 0;
            $cont = 0;
            foreach( json_decode($res->getBody()->getContents())->IPCs as $ipc){
                $cont++;
                $acum+= floatval(str_replace(",",".",$ipc->Valor));
            }
            array_unshift($arreglo_promedios,round($acum/$cont,2));
            $fecha->subMonth();
        }
        return response()->json(['data' => $arreglo_promedios, 'meses' => $arreglo_meses]);
    }
}
