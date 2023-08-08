<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sede;
use App\Models\Bitacora;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SedeController extends Controller
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
        $sedes = Sede::leftjoin('estados', 'sedes.estado_id', '=', 'estados.id')
        ->select([
            'sedes.id',
            'sedes.nombre',
            'estados.nombre as estado_id'
        ])
        ->orderBy("id")
        ->get();
        return $sedes;
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
        $sedes = new Sede();
        $sedes->nombre = Str::upper($request->nombre);
        $sedes->estado_id = $request->estado_id;
        $sedes->save();

        $estado = DB::table('estados')
                ->where('id', $sedes->estado_id)
                ->value('nombre');

        $bitacora = new Bitacora();
        $bitacora->usuario_id = Auth::id();
        $bitacora->descripcion = 
            "Creó una nueva sede, con nombre: ". 
            $sedes->nombre .
            ", Del estado de : ". 
            $estado;            
        $bitacora->save();

        return $sedes;

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
        $sedes = Sede::find($id);
        $nombre_anterior = $sedes->nombre;

        //Se recupera el valor anterior antes del request
        $estado_anterior = DB::table('estados')
                ->where('id', $sedes->estado_id)
                ->value('nombre');
        
        $sedes->nombre = Str::upper($request->nombre);
        $sedes->estado_id = $request->estado_id;
        $sedes->save();

        //Se obtiene el valor después del request
        $estado = DB::table('estados')
                ->where('id', $sedes->estado_id)
                ->value('nombre');
        
        $bitacora = new Bitacora();
        $bitacora->usuario_id = Auth::id();
        $bitacora->descripcion =
            " Actualizó el curso con id: ".
            $id.
            ", que antes se llamaba: " .
            $nombre_anterior. 
            ", por el nuevo nombre: ". 
            $sedes->nombre.
            ", del estado que antes era: ".
            $estado_anterior.
            ", al nuevo estado: ". 
            $estado;            
        $bitacora->save();
        return $sedes;
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
