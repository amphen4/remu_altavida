<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Afp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminAfpsController extends Controller
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
        return view('afps.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('afps.crear');
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


        $nuevo = new Afp();
        $nuevo->nombre = $request->nombre;
        $nuevo->porcentaje = $request->porcentaje;
        $nuevo->save();
        return redirect()->route('afps.index')->with('exito','Los datos de la AFP han sido agregados con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $afp = Afp::find($id);
        return view('afps.editar',['afp' => $afp]);
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
        $afp = Afp::findOrFail($id);
        $request->validate([
            'nombre' => 'required|string|max:190',
            'porcentaje' => 'required|numeric|min:0|max:100',
        ]);
        $afp->nombre = $request->nombre;
        $afp->porsentaje = $request->porcentaje;
        $afp->save();
        

        return redirect()->route('afps.index')->with('exito','Los datos de la AFP se han actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $afp = Afp::findOrFail($id);
        $afp->delete();
        return response(200);
    }
  public function data()
    {
        $wea['data'] = Afp::all()->toArray();

        //dd($wea['data']);
        return json_encode($wea);

        //return User::all()->toJson('data');
    }
}
