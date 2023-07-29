<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Persona;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
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
        $usuario = DB::table('usuarios')
        ->join('personas' , 'usuarios.persona_id' , '=' , 'personas.id')
        ->join('empleados' , 'empleados.persona_id', '=' , 'personas.id')
        ->join('puestos', 'empleados.puesto_id', '=' , 'puestos.id')
        ->join('adscripciones', 'empleados.adscripcion_id', '=' ,'adscripciones.id')
        ->join('niveles', 'empleados.nivel_id', '=' , 'niveles.id')
        ->join('estados', 'empleados.estado_id', '=' , 'estados.id')
        ->join('grado_estudios', 'personas.grado_estudios_id', '=' , 'grado_estudios.id')
        ->select(
            'usuarios.id',
            DB::raw("CONCAT(personas.nombres,' ',personas.apellido_pat,' ',personas.apellido_mat) AS persona_id"),
            'empleados.num_empleado',
            'empleados.fecha_ingr',
            'empleados.ciudad_adscripcion',
            'estados.nombre as estado_id',
            'personas.rfc',
            'personas.curp',
            'personas.sexo',
            'personas.nombre_grado_estudios',
            'grado_estudios.nombre as grado_estudios_id',
            'puestos.nombre as puesto_id',
            'adscripciones.nombre as adscripcion_id',
            'niveles.nombre as nivel_id',
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
        $personas = new Persona();
        $personas->apellido_pat = $request->apellido_pat;
        $personas->apellido_mat = $request->apellido_mat;
        $personas->nombres = $request->nombres;
        $personas->rfc = Str::upper($request->rfc);
        $personas->curp = $request->curp;
        $personas->sexo = $request->sexo;
        $personas->grado_estudios_id = $request->grado_estudios_id;
        $personas->nombre_grado_estudios = $request->nombre_grado_estudios;
        $personas->save();

        $empleados = new Empleado();
        $empleados->num_empleado = $request->num_empleado;
        $empleados->persona_id = $personas->id;
        $empleados->fecha_ingr = $request->fecha_ingr;
        $empleados->nivel_id = $request->nivel_id;
        $empleados->puesto_id = $request->puesto_id;
        $empleados->adscripcion_id = $request->adscripcion_id;
        $empleados->estado_id = $request->estado_id;
        $empleados->ciudad_adscripcion = $request->ciudad_adscripcion;
        $empleados->save();

        $usuarios = new Usuario();
        $usuarios->persona_id = $personas->id;
        $usuarios->correo = $request->correo;
        $usuarios->usuario = $request->curp;
        $usuarios->password = Hash::make($request->password);
        $usuarios->indicio = $request->indicio;
        $usuarios->rol = $request->rol;
        $usuarios->estatus = $request->estatus;
        $usuarios->save();
        
        
        /* $usuarios = new User();
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
        $usuarios->save(); */
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
        $usuarios = Usuario::find($id);
        $usuarios->correo = $request->correo;
        $usuarios->estatus = $request->estatus;
        $usuarios->save();

        $personas = Persona::find($usuarios->persona_id);
        $personas->nombre_grado_estudios = $request->nombre_grado_estudios;
        $personas->save();

        $empleados = new Empleado();
        $empleados->persona_id = $usuarios->persona_id;
        $empleados->fecha_ingr = $request->fecha_ingr;
        $empleados->save();

        //$usuarios->id = $request->id;
        //$usuarios->curp = $request->curp;
        //$usuarios->nombreCompleto = $request->nombreCompleto;
        //$usuarios->sexo = $request->sexo;
        /* $usuarios->numEmpl = $request->numEmpl;
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
        $usuarios->save(); */
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
        
        $autenticado = DB::table('usuarios')
        ->join('empleados', 'usuarios.persona_id', '=' , 'empleados.persona_id')
        ->leftjoin('empleados as superior', 'empleados.empleado_id' , '=' , 'superior.id')
        ->leftjoin('puestos as puesto_superior', 'superior.puesto_id', '=' , 'puesto_superior.id') 
        ->join('personas' , 'empleados.persona_id' , '=' , 'personas.id')
        ->join('puestos', 'empleados.puesto_id', '=' , 'puestos.id')
        ->join('adscripciones', 'empleados.adscripcion_id', '=' ,'adscripciones.id')
        ->join('niveles', 'empleados.nivel_id', '=' , 'niveles.id') 
        ->select([
            'usuarios.id',
            'usuarios.correo',
            'empleados.fecha_ingr as fecha_ingr',
            'puesto_superior.nombre as empleado_id',
            'empleados.num_empleado as num_empleado',
            DB::raw("CONCAT(personas.nombres,' ',personas.apellido_pat,' ',personas.apellido_mat) AS persona_id"),
            'personas.curp as curp',  
            'puestos.nombre as puesto_id',
            'adscripciones.nombre as adscripcion_id',
            'niveles.nombre as nivel_id',
        ])
        ->where('usuarios.id', Auth::user()->id)
        ->orderBy("empleados.id" , 'DESC')
        ->limit(1)
        ->get();
        return $autenticado;
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
        $usuario = Usuario::find($id);
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
        $usuario = Usuario::find($id);
        //$usuario->indicio = 'actualizado';
        $usuario->password = Hash::make($request->password);
        //$usuario->rfc = $request->rfc;
        $usuario->save();
        return $usuario;
    }
}
