<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Institucion;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $calificaciones = Calificacion::leftJoin('curso', 'calificacion.curso', '=', 'curso.id_curso')
        ->leftJoin('users', 'calificacion.empleado', '=', 'users.id')
        ->select([
            'calificacion.id_calificacion',
            'users.name as empleado',
            'curso.nombre as curso',
            'calificacion.calif',
            'calificacion.hrsCap',
            'calificacion.fecha',
            'calificacion.anio',
            'calificacion.cursoOblig',
            'calificacion.categoriaInst',

        ])
        ->where('users.id', Auth::user()->id)
        ->get();
        return $calificaciones; */

        $cursos = Curso::leftJoin('institucion', 'curso.id_institucion', '=', 'institucion.id_institucion')
        ->select([
            'curso.id_curso',
            'curso.nombre',
            'curso.fecha_inicio',
            'curso.fecha_fin',
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
        $cursos->id_institucion = $request->id_institucion;
        $cursos->folio = $request->folio;
        $cursos->save();
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
        $cursos->id_institucion = $request->id_institucion;
        $cursos->save();
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
}
