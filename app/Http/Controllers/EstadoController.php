<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EstadoController extends Controller
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
        $estados = Estado::select(
            'estados.id',
            'estados.nombre',
        )
        ->orderBy("id")
        ->get();
        return $estados; 
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
        $estados = new Estado();
        $estados->nombre = Str::upper($request->nombre);
        $estados->save();

        $bitacora = new Bitacora();
        $bitacora->usuario_id = Auth::id();
        $bitacora->descripcion = "Creó un nuevo estado llamado: ". " " . $estados->nombre;
        $bitacora->save(); 

        return $estados;
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
        $estados = Estado::find($id);
        $estados->nombre = Str::upper($request->nombre);
        $estados->save();

        $bitacora = new Bitacora();
        $bitacora->usuario_id = Auth::id();
        $bitacora->descripcion = "Actualizó el estado con id: " .$id. " por el nuevo nombre:". " " . $estados->nombre;
        $bitacora->save(); 

        return $estados;
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
