<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
class AnexoController extends Controller
{
    public function montoImpuestoRenta($monto_imponible)
    {
        if($monto_imponible < 0) return json_decode(0);
        if($monto_imponible >= env("MONTO_ULTIMO_TRAMO")) return json_decode(intval($monto_imponible*floatval(env("FACTOR_ULTIMO_TRAMO"))));
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
        $pdf = PDF::loadView('pdf_test');
        return $pdf->stream('invoice.pdf');
    }
}
