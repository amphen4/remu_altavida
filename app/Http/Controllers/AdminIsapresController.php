<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Isapre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminIsapresController extends Controller
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
        return view('isapres.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('isapres.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:190',
            'porcentaje' => 'required|numeric|min:0|max:100',
        ]);


        $nuevo = new Isapre();
        $nuevo->nombre = $request->nombre ;
        $nuevo->porcentaje = $request->porcentaje ;
        $nuevo->save();
        return redirect()->route('isapres.index')->with('exito','La isapre ha sido agregada con exito!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $isapre = Isapre::find($id);
        return view('isapres.editar',['isapre' => $isapre]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $isapre = Isapre::findOrFail($id);
        $request->validate([
            'nombre' => 'required|string|max:190',
            'porcentaje' => 'required|numeric|min:0|max:100',
        ]);

        $isapre->nombre = $request->nombre;
        $isapre->porcentaje = $request->porcentaje;

        $isapre->save();


        return redirect()->route('isapres.index')->with('exito','La isapre fue actualizada con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd('kewea');
        $isapre = Isapre::findOrFail($id);
        $isapre->delete();
        return response(200);
    }


    public function data()
    {
        $wea['data'] = Isapre::all()->toArray();

        //dd($wea['data']);
        return json_encode($wea);

        //return User::all()->toJson('data');
    }
    
}
