<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nivel;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NivelController extends Controller
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
        $niveles = Nivel::select(
            'niveles.id',
            'niveles.nomenclatura',
            'niveles.nombre'
        )
        ->orderBy("id")
        ->get();
        return $niveles; 
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
        $niveles = new Nivel();
        $niveles->nomenclatura = $request->nomenclatura;
        $niveles->nombre = Str::upper($request->nombre);
        $niveles->save();

        $bitacora = new Bitacora();
        $bitacora->usuario_id = Auth::id();
        $bitacora->descripcion = "Creó un nuevo nivel, con nomenclatura: ". $request->nomenclatura . ", llamado: " . $niveles->nombre;
        $bitacora->save();

        return $niveles;
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
        $niveles = Nivel::find($id);
        $niveles->nomenclatura = $request->nomenclatura;
        $niveles->nombre = Str::upper($request->nombre);
        $niveles->save();

        $bitacora = new Bitacora();
        $bitacora->usuario_id = Auth::id();
        $bitacora->descripcion = "Actualizó el nivel con id: ". $id .  ", por la nomenclatura: ". $request->nomenclatura . ", y por el nombre: " . $niveles->nombre;
        $bitacora->save();

        return $niveles;
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
