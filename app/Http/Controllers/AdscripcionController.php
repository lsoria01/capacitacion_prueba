<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adscripcion;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
            'adscripcion.id_adscripcion',
            'adscripcion.descripcion',
        )
        ->orderBy("id_adscripcion")
        ->get();
        return $adscripciones; 
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
        $adscripciones->descripcion = Str::upper($request->descripcion);
        $adscripciones->save();        

        $bitacora = new Bitacora();
        $bitacora->id_user = Auth::id();
        $bitacora->descripcion = "Creó una nueva adscripción llamada: ". " " . $request->descripcion;
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
    public function update(Request $request, $id_adscripcion)
    {
        $adscripciones = Adscripcion::find($id_adscripcion);
        $adscripciones->descripcion = Str::upper($request->descripcion);
        $adscripciones->save();

        $bitacora = new Bitacora();
        $bitacora->id_user = Auth::id();
        $bitacora->descripcion = "Actualizó la adscripción con id: " .$id_adscripcion. " por el nuevo nombre:". " " . $request->descripcion;
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
