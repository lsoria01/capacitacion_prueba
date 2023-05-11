<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GradoEstudio;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GradoEstudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grados = GradoEstudio::select(
            'gradoEst.id_gradoEst',
            'gradoEst.nombre',
        )
        ->orderBy("id_gradoEst")
        ->get();
        return $grados; 
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
        $grados = new GradoEstudio();
        $grados->nombre = Str::upper($request->nombre);
        $grados->save();

        $bitacora = new Bitacora();
        $bitacora->id_user = Auth::id();
        $bitacora->descripcion = "Creó un nuevo grado de estudios llamado: ". " " . $request->nombre;
        $bitacora->save(); 
        
        return $grados;
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
    public function update(Request $request, $id_gradoEst)
    {
        $grados = GradoEstudio::find($id_gradoEst);
        $grados->nombre = Str::upper($request->nombre);
        $grados->save();

        $bitacora = new Bitacora();
        $bitacora->id_user = Auth::id();
        $bitacora->descripcion = "Actualizó el grado de estudios con id: " .$id_gradoEst. " por el nuevo nombre:". " " . $request->nombre;
        $bitacora->save(); 

        return $grados;
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
