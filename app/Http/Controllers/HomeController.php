<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use App\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home',['user' => Auth::user()]);
    }
    public function profile()
    {
        $user = Auth::user();
        if(User::where('role_id',1)->count() == 1 && $user->role()->first()->name == 'admin') $quedaUnAdmin = true;
        else $quedaUnAdmin = false;
        return view('profile', ['user' => $user, 'quedaUnAdmin' => $quedaUnAdmin ]);
    }
    public function enviarFoto($id){
        //dd('wea');
        $user = User::findOrFail($id);
        if(Storage::disk('fotos-usuarios')->exists($user->id.'.jpg'))
        {
            return new Response(Storage::disk('fotos-usuarios')->get($user->id.'.jpg'),200);
        } 
        return new Response(Storage::disk('fotos-usuarios')->get('sinfoto.jpg'),200);
    }
    public function profileUpdate(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:190',
            'email' => ['required','string','email','max:190', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|numeric|min:1|max:2',
            'perfil' => 'nullable|image|max:2000|mimes:jpeg'
        ]);
        if($request->perfil)
        {
            $file = $request->file('perfil');
            $filename = Auth::user()->id.'.jpg';
            if($file)
            {
                Storage::disk('fotos-usuarios')->put($filename, File::get($file));
            }
        }
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
        

        return redirect()->route('home')->with('exito','Tus datos han sido actualizados con éxito!');
    }
}
