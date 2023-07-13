<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Nombramiento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = DB::table('usuarios')
        ->join('personas' , 'usuarios.persona_id' , '=' , 'personas.id')
        ->select(
            'usuarios.id',
            DB::raw("CONCAT(personas.nombres,' ',personas.apellido_pat,' ',personas.apellido_mat) AS persona_id"),
            'usuarios.correo',
            'usuarios.usuario',
            'usuarios.rol',
            'usuarios.estatus'
            )
        ->orderBy("id")
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
        $usuarios->numEmpl = $request->numEmpl;
        $usuarios->curp = $request->curp;
        $usuarios->nombreCompleto = $request->nombreCompleto;
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
        //$usuarios->nombreCompleto = $request->nombreCompleto;
        //$usuarios->sexo = $request->sexo;
        $usuarios->numEmpl = $request->numEmpl;
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
        
    }

    public function autenticado(){
        
        $autenticado = DB::table('users')
        ->join('puesto', 'users.id_puesto', '=' , 'puesto.id_puesto')
        ->join('adscripcion', 'users.id_adscripcion', '=' , 'adscripcion.id_adscripcion')
        ->join('nivel' , 'users.id_nivel', '=' , 'nivel.id_nivel')
        ->join('users as superior', 'users.id_superior' , '=' , 'superior.id' )
        ->join('puesto as puesto_superior', 'superior.id_puesto', '=' , 'puesto_superior.id_puesto')
        ->select([
            'users.id',
            'users.numEmpl',
            'users.nombreCompleto',
            'puesto.descripcion as id_puesto',
            'adscripcion.descripcion as id_adscripcion',
            'nivel.nomenclatura as id_nivel',
            'puesto_superior.descripcion as id_superior',
            'users.email',
            'users.curp',
            'users.fechaIngr'
        ])
        ->where('users.id', Auth::user()->id)
        ->get();
        return $autenticado;
    }

    public function nombramientoAuth(){
        $nombramiento = Nombramiento::leftJoin('users', 'nombramiento.id_user', '=' , 'users.id')
        ->select([
            'nombramiento.id_nombramiento',
            'users.nombreCompleto as id_user',
            'nombramiento.tipo',
            'nombramiento.fecEmis',
            'nombramiento.fecRatif'
        ])
        ->where('users.id', Auth::user()->id)
        ->get();
        return $nombramiento;
    }

    public function usrActual(){
        $usrActual = Auth::user()->Persona->nombres . ' ' .  Auth::user()->Persona->apellido_pat . ' ' . Auth::user()->Persona->apellido_mat ;
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

    public function actualizaPassword(Request $request, $id)
    {
        $usuario = User::find($id);
        //$usuario->indicio = 'actualizado';
        $usuario->password = Hash::make($request->password);
        //$usuario->rfc = $request->rfc;
        $usuario->save();
        return $usuario;
    }
}
