<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Institucion;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CursoController extends Controller
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
        $cursos = Curso::leftJoin('instituciones', 'cursos.institucion_id', '=', 'instituciones.id')
        ->leftJoin('estatus', 'cursos.estatus_id', '=', 'estatus.id')
        ->select([
            'cursos.id',
            'cursos.nombre',
            'cursos.fecha_inicio',
            'cursos.fecha_fin',
            'cursos.curso_oblig',
            'cursos.hrs_cap',
            'cursos.curso_int_ext',
            'cursos.difundido_DP',
            'cursos.modalidad',
            'estatus.nombre as estatus_id',
            'instituciones.nombre as institucion_id',
            'cursos.identificador_curso'
        ])
        ->orderBy("id")
        ->get();
        return $cursos;
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
        $cursos = new Curso();
        $cursos->nombre = Str::upper($request->nombre);
        $cursos->fecha_inicio = $request->fecha_inicio;
        $cursos->fecha_fin = $request->fecha_fin;
        $cursos->curso_oblig = $request->curso_oblig;
        $cursos->hrs_cap = $request->hrs_cap;
        $cursos->curso_int_ext = $request->curso_int_ext;
        $cursos->difundido_DP = $request->difundido_DP;
        $cursos->modalidad = $request->modalidad;
        $cursos->estatus_id = $request->estatus_id;
        $cursos->institucion_id = $request->institucion_id;
        $cursos->identificador_curso = $request->identificador_curso;
        $cursos->save();

        $institucion = DB::table('instituciones')
                ->where('id', $request->id)
                ->value('nombre');

        $bitacora = new Bitacora();
        $bitacora->usuario_id = Auth::id();
        $bitacora->descripcion = "Creó un nuevo curso, con nombre: ". $cursos->nombre . ", con fecha de inicio: " . $request->fecha_inicio. ", con fecha de fin: ".$request->fecha_fin. ", de la Institución: ".$institucion. " y con curso ID: " . $request->identificador_curso;
        $bitacora->save();

        return $cursos;
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
        $cursos = Curso::find($id);
        $cursos->nombre = Str::upper($request->nombre);
        $cursos->fecha_inicio = $request->fecha_inicio;
        $cursos->fecha_fin = $request->fecha_fin;
        $cursos->curso_oblig = $request->curso_oblig;
        $cursos->hrs_cap = $request->hrs_cap;
        $cursos->cursoIntExt = $request->cursoIntExt;
        $cursos->difundidoDP = $request->difundidoDP;
        $cursos->modalidad = $request->modalidad;
        $cursos->id_estatus = $request->id_estatus;
        $cursos->identificador_curso = $request->identificador_curso;
        $cursos->id_institucion = $request->id_institucion;
        $cursos->save();

        $institucion = DB::table('institucion')
                ->where('id_institucion', $request->id_institucion)
                ->value('descripcion');

        $bitacora = new Bitacora();
        $bitacora->usuario_id = Auth::id();
        $bitacora->descripcion = "Actualizó el curso con id: " .$id. ", por el nuevo nombre: ". $request->nombre . ", por la nueva fecha de inicio: " . $request->fecha_inicio. ", por la nueva fecha de fin: ".$request->fecha_fin. ", por la nueva Institución: ".$institucion. " y por el nuevo curso ID: " . $request->identificador_curso;
        $bitacora->save();
        
        return $cursos;
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

    public function nombreInstituciones(){
        $instituciones = Institucion::select(
            'institucion.id_institucion',
            'institucion.descripcion',
            'institucion.tipo',
            'institucion.siglas'
        )
        ->orderBy("id_institucion")
        ->get();
        return $instituciones; 

    }

    public function validar($id_curso){
        $curso = Curso::find($id_curso);
        if($curso->id_estatus == 1){
            $curso->id_estatus = 2;
            $curso->save();
            return ("Curso validado con éxito");
        }else{
            return ("Error desde el controller");
            //mensaje del fracaso de la finalización
        }
    }
}
