<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminUsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(User::where('role_id',1)->count() == 1) $quedaUnAdmin = true;
        else $quedaUnAdmin = false;
        return view('usuarios.listar',['quedaUnAdmin' => $quedaUnAdmin]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.crear');
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
            'name' => 'required|string|max:190',
            'email' => 'required|string|email|max:190|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|numeric|min:1|max:2'
        ]);
        
        switch($request->role){
            case '1':
                $rol = 'admin';
                break;
            case '2':
                $rol = 'secretary';
                break;
        }

        $role = Role::where('name', $rol)->first();
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role()->associate($role);
        $user->save();
        

        return redirect()->route('usuarios.index');
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
        $user = User::find($id);
        return view('usuarios.editar',['user' => $user]);
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
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:190',
            'email' => ['required','string','email','max:190', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|numeric|min:1|max:2'
        ]);
        if(!empty($request->password))
        {
            $user->password = bcrypt($request->password);
        }
        $user->email = $request->email;
        $user->name = $request->name;
        switch($request->role){
            case '1':
                $rol = 'admin';
                break;
            case '2':
                $rol = 'secretary';
                break;
        }
        $role = Role::where('name', $rol)->first();
        $user->role()->associate($role);
        $user->save();
        

        return redirect()->route('usuarios.index')->with('exito','El usuario fue actualizado con éxito!');
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
        $user = User::findOrFail($id);
        $user->delete();
        return response(200);
    }
    public function data()
    {
        $wea['data'] = User::all()->toArray();

        if(User::where('role_id',1)->count() == 1){
            foreach($wea['data'] as &$user){

                if($user["role_name"] == 'admin'){

                    $user["opciones"] = str_replace('botonEliminar','disabled',$user["opciones"]);
                    
                }
            }
        }
        //dd($wea['data']);
        return json_encode($wea);

        //return User::all()->toJson('data');
    }
}
