<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GradoEstudio;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GradoEstudioController extends Controller
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
        $grados = GradoEstudio::select(
            'grado_estudios.id',
            'grado_estudios.nombre',
        )
        ->orderBy("id")
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
        $bitacora->usuario_id = Auth::id();
        $bitacora->descripcion = "Creó un nuevo grado de estudios llamado: ". " " . $grados->nombre;
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
    public function update(Request $request, $id)
    {
        $grados = GradoEstudio::find($id);
        $grados->nombre = Str::upper($request->nombre);
        $grados->save();

        $bitacora = new Bitacora();
        $bitacora->usuario_id = Auth::id();
        $bitacora->descripcion = "Actualizó el grado de estudios con id: " .$id. " por el nuevo nombre:". " " . $grados->nombre;
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
