<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;

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
}
