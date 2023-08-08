<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adscripcion;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdscripcionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adscripciones = Adscripcion::select(
            'adscripciones.id',
            'adscripciones.nombre',
        )
        ->orderBy("id")
        ->get();
        return $adscripciones; 

        /* $fecha = Carbon::now('America/Mexico_City');
        return $fecha->format('l jS \\of F Y h:i:s A'); */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $adscripciones = new Adscripcion();
        $adscripciones->nombre = Str::upper($request->nombre);
        $adscripciones->save();        

        $bitacora = new Bitacora();
        $bitacora->usuario_id = Auth::id();
        $bitacora->descripcion = 
        " Creó una nueva adscripción llamada: ".
        $adscripciones->nombre;
        $bitacora->save(); 

        return $adscripciones;
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
        //
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
        $adscripciones = Adscripcion::find($id);
        $nombre_anterior = $adscripciones->nombre;
        $adscripciones->nombre = Str::upper($request->nombre);
        $adscripciones->save();

        $bitacora = new Bitacora();
        $bitacora->usuario_id = Auth::id();
        $bitacora->descripcion = 
        "Actualizó la adscripción con id: " .
        $id.
        ", que antes se llamaba: " .
        $nombre_anterior. 
        " por el nuevo nombre: ".
        $adscripciones->nombre;
        $bitacora->save(); 

        return $adscripciones;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
