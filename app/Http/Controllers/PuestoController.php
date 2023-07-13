<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use Illuminate\Http\Request;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PuestoController extends Controller
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
        $puestos = Puesto::select(
            'puestos.id',
            'puestos.nombre',
        )
        ->orderBy("id")
        ->get();
        return $puestos; 
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
        $puestos = new Puesto();
        $puestos->nombre = Str::upper($request->nombre);
        $puestos->save();

        $bitacora = new Bitacora();
        $bitacora->usuario_id = Auth::id();
        $bitacora->descripcion = "Creó un nuevo puesto llamado: ". " " . $puestos->nombre;
        $bitacora->save(); 

        return $puestos;
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
        $puestos = Puesto::find($id);
        $puestos->nombre = Str::upper($request->nombre);
        $puestos->save();

        $bitacora = new Bitacora();
        $bitacora->usuario_id = Auth::id();
        $bitacora->descripcion = "Actualizó el puesto con id: " .$id. " por el nuevo nombre:". " " . $puestos->nombre;
        $bitacora->save(); 

        return $puestos;
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
