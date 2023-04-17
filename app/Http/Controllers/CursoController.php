<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Institucion;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Curso::leftJoin('institucion', 'curso.id_institucion', '=', 'institucion.id_institucion')
        ->leftJoin('estatus', 'curso.id_estatus', '=', 'estatus.id_estatus')
        ->select([
            'curso.id_curso',
            'curso.nombre',
            'curso.fecha_inicio',
            'curso.fecha_fin',
            'curso.cursoOblig',
            'curso.hrsCap',
            'curso.cursoIntExt',
            'curso.difundidoDP',
            'curso.modalidad',
            'estatus.nombre as id_estatus',
            'institucion.descripcion as id_institucion',
            'curso.folio'
        ])
        ->orderBy("id_curso")
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
        $cursos->nombre = $request->nombre;
        $cursos->fecha_inicio = $request->fecha_inicio;
        $cursos->fecha_fin = $request->fecha_fin;
        $cursos->cursoOblig = $request->cursoOblig;
        $cursos->hrsCap = $request->hrsCap;
        $cursos->cursoIntExt = $request->cursoIntExt;
        $cursos->difundidoDP = $request->difundidoDP;
        $cursos->modalidad = $request->modalidad;
        $cursos->id_estatus = $request->id_estatus;
        $cursos->id_institucion = $request->id_institucion;
        $cursos->folio = $request->folio;
        $cursos->save();

        $institucion = DB::table('institucion')
                ->where('id_institucion', $request->id_institucion)
                ->value('descripcion');

        $bitacora = new Bitacora();
        $bitacora->id_user = Auth::id();
        $bitacora->descripcion = "Creó un nuevo curso, con nombre: ". $request->nombre . ", con fecha de inicio: " . $request->fecha_inicio. ", con fecha de fin: ".$request->fecha_fin. ", de la Institución: ".$institucion. " y con folio: " . $request->folio;
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
    public function update(Request $request, $id_curso)
    {
        $cursos = Curso::find($id_curso);
        $cursos->nombre = $request->nombre;
        $cursos->fecha_inicio = $request->fecha_inicio;
        $cursos->fecha_fin = $request->fecha_fin;
        $cursos->cursoOblig = $request->cursoOblig;
        $cursos->hrsCap = $request->hrsCap;
        $cursos->cursoIntExt = $request->cursoIntExt;
        $cursos->difundidoDP = $request->difundidoDP;
        $cursos->modalidad = $request->modalidad;
        $cursos->id_estatus = $request->id_estatus;
        $cursos->folio = $request->folio;
        $cursos->id_institucion = $request->id_institucion;
        $cursos->save();

        $institucion = DB::table('institucion')
                ->where('id_institucion', $request->id_institucion)
                ->value('descripcion');

        $bitacora = new Bitacora();
        $bitacora->id_user = Auth::id();
        $bitacora->descripcion = "Actualizó el curso con id: " .$id_curso. ", por el nuevo nombre: ". $request->nombre . ", por la nueva fecha de inicio: " . $request->fecha_inicio. ", por la nueva fecha de fin: ".$request->fecha_fin. ", por la nueva Institución: ".$institucion. " y por el nuevo folio: " . $request->folio;
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
