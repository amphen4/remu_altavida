<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function data()
    {
    	return Event::all()->toJson();
    }
    public function store(Request $request)
    {
    	$request->validate([
            'start' => 'required|date',
            'end' => 'nullable|date',
            'evento' => 'required|string|max:250',
        ]);

        $wow = new Event;
        $wow->start = $request->start;
        if(!empty($request->end)){
        	$wow->end = $request->end;
        }
        $wow->title = $request->evento;
        $wow->save();

        return response(200);
    }
    public function actualizar(Request $request, $id)
    {
        $wow = Event::findOrFail($id);
        $this->validate($request, ['title' => 'required|string|max:100',
                                    'start' => 'required',
                                    'end' => 'required',
                                  ]);
        $wow->title = $request->title;
        $wow->start = $request->start;
        $wow->end = $request->end;
        $wow->save();
        return response()->json([
            'wow' => 'Wow'
        ]);
    }
    public function eliminar(Request $request,$id)
    {
        $this->validate($request, ['method' => 'required|in:DELETE',
                                    
                                  ]);
        Event::findOrFail($id);
        Event::destroy($id);
        return response()->json([
            'wow' => 'Wow'
        ]);
    }
}
