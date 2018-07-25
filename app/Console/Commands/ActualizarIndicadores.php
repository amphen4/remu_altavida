<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Indicador;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ActualizarIndicadores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'indicador';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Obtiene los indicadores economicos del dia actual conectandose a una api o webservice, y los agrega a la tabla en bd';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
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

        $res = $client->request('GET', 'https://api.sbif.cl/api-sbifv3/recursos_api/utm/'.$ano.'/'.$mes.'?apikey=243ee93523145ebdd7f6f2d9c1a3320401bbee5d&formato=json');
        $string_utm = str_replace(',','.',json_decode($res->getBody()->getContents())->UTMs[0]->Valor);
        $valor_utm = floatval($string_utm);
        /*
        $res = $client->request('GET', 'https://api.sbif.cl/api-sbifv3/recursos_api/ipc/'.$ano.'/'.$mes.'?apikey=243ee93523145ebdd7f6f2d9c1a3320401bbee5d&formato=json');
        $string_utm = str_replace(',','.',json_decode($res->getBody()->getContents())->UTMs[0]->Valor);
        $valor_utm = floatval($string_uf);
        */
        Log::info('Indicadores obtenidos: Dolar - Euro - UF - UTM');

        $nuevo = new Indicador;
        $nuevo->dolar = $valor_dolar;
        $nuevo->euro = $valor_euro;
        $nuevo->uf = $valor_uf;
        $nuevo->utm = $valor_utm;
        $nuevo->save();

        Log::info('Indicadores ingresados a la BD');

    }
}
