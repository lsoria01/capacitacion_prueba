<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Nombramiento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = User::leftJoin('puesto', 'users.id_puesto', '=', 'puesto.id_puesto')
        ->leftJoin('adscripcion', 'users.id_adscripcion', '=', 'adscripcion.id_adscripcion')
        ->leftJoin('nivel', 'users.id_nivel', '=', 'nivel.id_nivel')
        ->leftJoin('estado', 'users.id_estado', '=', 'estado.id_estado')
        ->leftJoin('gradoEst', 'users.id_gradoEst', '=', 'gradoEst.id_gradoEst')
        ->select([
            'users.id',
            'users.name as nombre',
            'puesto.descripcion as id_puesto',
            'adscripcion.descripcion as id_adscripcion',
            'nivel.nomenclatura as id_nivel',
            'estado.nombre as id_estado',
            'users.email',
            'users.curp',
            'users.fechaIngr',
            'users.estatus',
            'users.sexo',
            'users.rfc',
            'users.email',
            'users.rol',
            'users.ciudadAdscr',
            'users.descripEstud',
            'gradoEst.nombre as id_gradoEst',
            'users.indicio'
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
        $usuarios = new User();
        $usuarios->id = $request->id;
        $usuarios->curp = $request->curp;
        $usuarios->name = $request->nombre;
        $usuarios->sexo = $request->sexo;
        $usuarios->rfc = Str::upper($request->rfc);
        $usuarios->email = $request->email;
        $usuarios->estatus = $request->estatus;
        $usuarios->rol = $request->rol;
        $usuarios->password = Hash::make($request->password);
        $usuarios->indicio = $request->indicio;
        $usuarios->fechaIngr = $request->fechaIngr;
        $usuarios->id_puesto = $request->id_puesto;
        $usuarios->id_nivel = $request->id_nivel;
        $usuarios->id_adscripcion = $request->id_adscripcion;
        $usuarios->ciudadAdscr = $request->ciudadAdscr;
        $usuarios->id_estado = $request->id_estado;
        $usuarios->id_gradoEst = $request->id_gradoEst;
        $usuarios->descripEstud = $request->descripEstud;
        $usuarios->save();
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
        $usuarios = User::find($id);
        //$usuarios->id = $request->id;
        //$usuarios->curp = $request->curp;
        //$usuarios->name = $request->name;
        //$usuarios->sexo = $request->sexo;
        $usuarios->rfc = $request->rfc;
        $usuarios->email = $request->email;
        $usuarios->estatus = $request->estatus;
        $usuarios->rol = $request->rol;
        $usuarios->password = Hash::make($request->password);
        $usuarios->indicio = $request->indicio;
        $usuarios->fechaIngr = $request->fechaIngr;
        $usuarios->id_puesto = $request->id_puesto;
        $usuarios->id_nivel = $request->id_nivel;
        $usuarios->id_adscripcion = $request->id_adscripcion;
        $usuarios->ciudadAdscr = $request->ciudadAdscr;
        $usuarios->id_estado = $request->id_estado;
        $usuarios->id_gradoEst = $request->id_gradoEst;
        $usuarios->descripEstud = $request->descripEstud;
        $usuarios->save();
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
        
        $autenticado = User::leftJoin('puesto', 'users.id_puesto', '=', 'puesto.id_puesto')
        ->leftJoin('adscripcion', 'users.id_adscripcion', '=', 'adscripcion.id_adscripcion')
        ->leftJoin('nivel', 'users.id_nivel', '=', 'nivel.id_nivel')
        ->select([
            'users.id',
            'users.name',
            'puesto.descripcion as id_puesto',
            'puesto.superior as superior',
            'adscripcion.descripcion as id_adscripcion',
            'nivel.nomenclatura as id_nivel',
            'users.email',
            'users.curp',
            'users.fechaIngr'
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

    public function idUsrActual(){
        $idUsrActual = Auth::user()->id;
        return $idUsrActual;
    }

    public function cambiaEstatus(Request $request, $id)
    {

        $usuario = User::find($id);
        if($usuario->estatus == true){
            $usuario->estatus = false;
        }
        else{
            $usuario->estatus = true;
        }
        $usuario->save();
        return $usuario;
    }
        /* $calificaciones = Calificacion::find($id_calificacion);

        $calificaciones-> rechazo = $request->rechazo;
        $calificaciones-> id_estatus = 3;
        $calificaciones->save(); 

        return $calificaciones; */

        
}
