<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institucion;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class InstitucionController extends Controller
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
        $instituciones = Institucion::select(
            'instituciones.id',
            'instituciones.nombre',
            'instituciones.tipo',
            'instituciones.siglas'
        )
        ->orderBy("id")
        ->get();
        return $instituciones; 
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
        $instituciones = new Institucion();
        $instituciones->nombre = Str::upper($request->nombre);
        $instituciones->tipo = $request->tipo;
        $instituciones->siglas = $request->siglas;
        $instituciones->save();

        $bitacora = new Bitacora();
        $bitacora->usuario_id = Auth::id();
        $bitacora->descripcion = "Creó un nueva Institución, con nombre: ". $instituciones->nombre . ", de tipo: " . $request->tipo. ", con siglas: ".$request->siglas ;
        $bitacora->save();

        return $instituciones;
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
        $instituciones = Institucion::find($id);
        $instituciones->nombre = Str::upper($request->nombre);
        $instituciones->tipo = $request->tipo;
        $instituciones->siglas = $request->siglas;
        $instituciones->save();

        $bitacora = new Bitacora();
        $bitacora->usuario_id = Auth::id();
        $bitacora->descripcion = "Actualizó la Institución con id: " .$id. ", por el nuevo nombre: ". $instituciones->nombre . ", por el tipo: " . $request->tipo. ", y por las siglas: ".$request->siglas ;
        $bitacora->save();

        return $instituciones;
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
