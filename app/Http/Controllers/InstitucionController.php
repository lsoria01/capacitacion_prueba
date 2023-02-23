<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institucion;

class InstitucionController extends Controller
{
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
        $instituciones->descripcion = $request->descripcion;
        $instituciones->tipo = $request->tipo;
        $instituciones->siglas = $request->siglas;
        $instituciones->save();
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
        $instituciones->descripcion = $request->descripcion;
        $instituciones->tipo = $request->tipo;
        $instituciones->siglas = $request->siglas;
        $instituciones->save();
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
