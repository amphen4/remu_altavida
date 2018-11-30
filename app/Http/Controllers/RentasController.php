<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Renta;
use Carbon\Carbon;
class RentasController extends Controller
{

    public function index()
    {
    	return view('rentas');
    }
    public function data()
    {
    	$wea['data'] = Renta::orderBy('fecha_desde', 'desc')->get()->toArray();
        return json_encode($wea);

        //return User::all()->toJson('data');
    }
    public function store(Request $request)
    {
    	$request->validate([
    		'monto_desde' => 'required|numeric|min:0|max:9999999',
    		'monto_hasta' => 'required|numeric|min:0|max:9999999',
    		'factor' => 'required|numeric|min:0|max:9999999',
    		'monto_rebajar' => 'required|numeric|min:0|max:9999999'
    	]);

    	$nuevo = new Renta();
    	$nuevo->monto_desde = $request->monto_desde;
    	$nuevo->monto_hasta = $request->monto_hasta;
    	$nuevo->factor = $request->factor;
    	$nuevo->cantidad_rebajar = $request->monto_rebajar;
    	$nuevo->fecha_desde = Carbon::now()->toDateString();
    	$nuevo->save();

    	return view('rentas');
    }
}
