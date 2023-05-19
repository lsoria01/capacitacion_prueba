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
            'institucion.id_institucion',
            'institucion.descripcion',
            'institucion.tipo',
            'institucion.siglas'
        )
        ->orderBy("id_institucion")
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
        $instituciones->descripcion = Str::upper($request->descripcion);
        $instituciones->tipo = $request->tipo;
        $instituciones->siglas = $request->siglas;
        $instituciones->save();

        $bitacora = new Bitacora();
        $bitacora->id_user = Auth::id();
        $bitacora->descripcion = "Creó un nueva Institución, con nombre: ". $request->descripcion . ", de tipo: " . $request->tipo. ", con siglas: ".$request->siglas ;
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
    public function update(Request $request, $id_institucion)
    {
        $instituciones = Institucion::find($id_institucion);
        $instituciones->descripcion = Str::upper($request->descripcion);
        $instituciones->tipo = $request->tipo;
        $instituciones->siglas = $request->siglas;
        $instituciones->save();

        $bitacora = new Bitacora();
        $bitacora->id_user = Auth::id();
        $bitacora->descripcion = "Actualizó la Institución con id: " .$id_institucion. ", por el nuevo nombre: ". $request->descripcion . ", por el tipo: " . $request->tipo. ", y por las siglas: ".$request->siglas ;
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
