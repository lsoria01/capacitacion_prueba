<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nombramiento;
use App\Models\Bitacora;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NombramientoController extends Controller
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
        $nombramientos = DB::table('nombramientos')
        ->join('usuarios', 'nombramientos.usuario_id', '=' , 'usuarios.id')
        ->join('personas', 'usuarios.persona_id', '=' , 'personas.id')
        ->select(
            'nombramientos.id',
             DB::raw("CONCAT(personas.nombres,' ',personas.apellido_pat,' ',personas.apellido_mat) AS usuario_id"),
            'nombramientos.tipo',
            'nombramientos.fec_emis',
            'nombramientos.fec_ratif'
        )
        ->orderBy("id")
        ->get();
        return $nombramientos;
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
        $nombramientos = new Nombramiento();
        $nombramientos->usuario_id = $request->usuario_id;
        $nombramientos->tipo = Str::upper($request->tipo);
        $nombramientos->fec_emis = $request->fec_emis;
        $nombramientos->fec_ratif = $request->fec_ratif;
        $nombramientos->save();

        $usuario = DB::table('usuarios')
                ->where('id', $nombramientos->usuario_id)
                ->value('usuario');

        $bitacora = new Bitacora();
        $bitacora->usuario_id = Auth::id();
        $bitacora->descripcion = 
        " Creó un nuevo nombramiento del tipo: ".
        $nombramientos->tipo.
        ", para el usuario: ".
        $usuario.
        ", con fecha de emisión: ".
        $nombramientos->fec_emis.
        ", y fecha de retificación: ".
        $nombramientos->fec_ratif;
        $bitacora->save(); 

        return $nombramientos;
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
        $nombramientos = Nombramiento::find($id);

        //Se recupera el valor anterior antes del request
        $usuario_anterior = DB::table('usuarios')
                ->where('id', $nombramientos->usuario_id)
                ->value('usuario');

        $nombramientos->usuario_id = $request->usuario_id;

        //Se obtiene el valor después del request
        $usuario = DB::table('usuarios')
                ->where('id', $nombramientos->usuario_id)
                ->value('usuario');

        $tipo_anterior = $nombramientos->tipo;
        $nombramientos->tipo = Str::upper($request->tipo);
        $fec_emis_anterior = $nombramientos->fec_emis;
        $nombramientos->fec_emis = $request->fec_emis;
        $fec_ratif_anterior = $nombramientos->fec_ratif;
        $nombramientos->fec_ratif = $request->fec_ratif;
        $nombramientos->save();
        $bitacora = new Bitacora();
        $bitacora->usuario_id = Auth::id();
        $bitacora->descripcion = 
        " Actualizó el nombramiento con id: ".
        $nombramientos->id.
        ", que era del tipo: ".
        $tipo_anterior.
        ", por el nuevo tipo: ".
        $nombramientos->tipo.
        ", para el usuario que antes era: ".
        $usuario_anterior.
        ", por el usuario que ahora es: ".
        $usuario.
        ", con fecha de emisión que era: ".
        $fec_emis_anterior.
        ", por la fecha de emisión que ahora es: ".
        $nombramientos->fec_emis.
        ", con fecha de ratificación que antes era: ".
        $fec_ratif_anterior.
        ", por la fecha de ratificación que ahora es: ".
        $nombramientos->fec_ratif;
        $bitacora->save(); 

        return $nombramientos;
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

    public function nombramientoAuth(){
        $nombramiento = DB::table('nombramientos')
        ->join('usuarios','nombramientos.usuario_id', '=' , 'usuarios.id')
        ->join('personas', 'usuarios.persona_id', '=' , 'personas.id')
        ->select([
            'nombramientos.id',
            DB::raw("CONCAT(personas.nombres,' ',personas.apellido_pat,' ',personas.apellido_mat) AS usuario_id"),
            'nombramientos.tipo',
            'nombramientos.fec_emis',
            'nombramientos.fec_ratif'
        ])
        ->where('nombramientos.usuario_id', Auth::user()->id)
        ->get();
        return $nombramiento;
    }
}
