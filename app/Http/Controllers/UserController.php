<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Nombramiento;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = User::leftJoin('puesto', 'users.puesto', '=', 'puesto.id_puesto')
        ->leftJoin('adscripcion', 'users.adscripcion', '=', 'adscripcion.id_adscripcion')
        ->select([
            'users.id',
            'users.name',
            'puesto.descripcion as puesto',
            'adscripcion.descripcion as adscripcion',
            'users.email',
            'users.curp'
        ])
        ->get();
        return $usuario;
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
        //
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
        //
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

    public function autenticado(){
        
        $autenticado = User::leftJoin('puesto', 'users.puesto', '=', 'puesto.id_puesto')
        ->leftJoin('adscripcion', 'users.adscripcion', '=', 'adscripcion.id_adscripcion')
        ->select([
            'users.id',
            'users.name',
            'puesto.descripcion as puesto',
            'adscripcion.descripcion as adscripcion',
            'users.email',
            'users.curp'
        ])
        ->where('users.id', Auth::user()->id)
        ->get();
        return $autenticado;
    }

    public function nombramientoAuth(){
        $nombramiento = Nombramiento::leftJoin('users', 'nombramiento.empleado', '=' , 'users.id')
        ->select([
            'nombramiento.id_nombramiento',
            'users.name as empleado',
            'nombramiento.tipo',
            'nombramiento.fecEmis',
            'nombramiento.fecRatif'
        ])
        ->where('users.id', Auth::user()->id)
        ->get();
        return $nombramiento;
    }

    public function usrActual(){
        $usrActual = Auth::user()->name;
        return $usrActual;
    }

    public function rol(){
        $rol = Auth::user()->rol;
        return $rol;
    }
}
