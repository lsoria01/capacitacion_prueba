<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nombramiento;
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
        $nombramientos->usuario_id = $request->usuario_id;
        $nombramientos->tipo = Str::upper($request->tipo);
        $nombramientos->fec_emis = $request->fec_emis;
        $nombramientos->fec_ratif = $request->fec_ratif;
        $nombramientos->save();
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
