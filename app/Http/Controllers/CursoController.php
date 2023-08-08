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
                ->where('id', $request->institucion_id)
                ->value('nombre');

        //Curso obligatorio
            if($cursos->curso_oblig){
                $curso_oblig = 'Si';
            }
            else{
                $curso_oblig = 'No';
            }
            
        //Curso Interno o Externo
            if($cursos->curso_int_ext){
                $curso_int_ext = 'Externo';
            }
            else{
                $curso_int_ext = 'Interno';
            }
        
        //Difundido por la DP
            if($cursos->difundido_DP){
                $difundido_DP = 'Si';
            }
            else{
                $difundido_DP = 'No';
            }

        $bitacora = new Bitacora();
        $bitacora->usuario_id = Auth::id();
        $bitacora->descripcion = 
            "Creó un nuevo curso, con nombre: ". 
            $cursos->nombre .
            ", Obligatorio: ". 
            $curso_oblig.
            ", con fecha de inicio: ". 
            $cursos->fecha_inicio. 
            ", con fecha de fin: ".
            $cursos->fecha_fin. 
            ", horas de capacitación: ".
            $cursos->hrs_cap.
            ", Curso interno o externo: ".
            $curso_int_ext.
            ", difundido por la DP: ".
            $difundido_DP.
            ", de la Institución: ".
            $institucion. 
            ", con curso ID: " .
            $cursos->identificador_curso.
            " y de la modalidad: " .
            $cursos->modalidad;
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

        $nombre_anterior = $cursos->nombre;
        $cursos->nombre = Str::upper($request->nombre);

        $fecha_inicio_anterior = $cursos->fecha_inicio;
        $cursos->fecha_inicio = $request->fecha_inicio;

        $fecha_fin_anterior = $cursos->fecha_fin;
        $cursos->fecha_fin = $request->fecha_fin;        

        /*** Curso obligatorio ***/
            //Antes del request
            if($cursos->curso_oblig){
                $curso_oblig_anterior = 'Si';
            }
            else{
                $curso_oblig_anterior = 'No';
            }

            $cursos->curso_oblig = $request->curso_oblig;     
            
            //Después del request
            if($cursos->curso_oblig){
                $curso_oblig = 'Si';
            }
            else{
                $curso_oblig = 'No';
            }

        /*** Curso Interno o Externo ***/
            //Antes del request
            if($cursos->curso_int_ext){
                $curso_int_ext_anterior = 'Externo';
            }
            else{
                $curso_int_ext_anterior = 'Interno';
            }

            $cursos->curso_int_ext = $request->curso_int_ext;
            //Después del request
            if($cursos->curso_int_ext){
                $curso_int_ext = 'Externo';
            }
            else{
                $curso_int_ext = 'Interno';
            }


        /*** Difundido por la DP ***/
            //Antes del request
            if($cursos->difundido_DP){
                $difundido_DP_anterior = 'Si';
            }
            else{
                $difundido_DP_anterior = 'No';
            }

            $cursos->difundido_DP = $request->difundido_DP;
            //Despúes del request
            if($cursos->difundido_DP){
                $difundido_DP = 'Si';
            }
            else{
                $difundido_DP = 'No';
            }

        $hrs_cap_anterior = $cursos->hrs_cap;
        $cursos->hrs_cap = $request->hrs_cap;

        $modalidad_anterior = $cursos->modalidad;
        $cursos->modalidad = $request->modalidad;

        $cursos->estatus_id = $request->estatus_id;

        $identificador_curso_anterior = $cursos->identificador_curso;
        $cursos->identificador_curso = $request->identificador_curso;
        
        //Se recupera el valor anterior antes del request
        $institucion_anterior = DB::table('instituciones')
                ->where('id', $cursos->institucion_id)
                ->value('nombre');

        $cursos->institucion_id = $request->institucion_id;
        $cursos->save();

        //Se obtiene el valor después del request
        $institucion = DB::table('instituciones')
                ->where('id', $cursos->institucion_id)
                ->value('nombre');

        $bitacora = new Bitacora();
        $bitacora->usuario_id = Auth::id();
        $bitacora->descripcion = 
            "Actualizó el curso con id: ".
            $id.
            ", que antes se llamaba: " .
            $nombre_anterior. 
            ", por el nuevo nombre: ".
            $cursos->nombre .
            ", de la fecha de inicio que antes era: ".
            $fecha_inicio_anterior.
            ", por la nueva fecha de inicio: ".
            $request->fecha_inicio.
            ", de la fecha de fin que antes era: ".
            $fecha_fin_anterior.
            ", por la nueva fecha de fin: ".
            $request->fecha_fin.
            ", de las horas de capacitación que antes eran: ".
            $hrs_cap_anterior.
            ", por las nuevas horas de capacitación: ".
            $cursos->hrs_cap.
            ", Curso interno o externo antes: ".
            $curso_int_ext_anterior.
            ", Curso interno o externo ahora: ".
            $curso_int_ext.
            ", difundido por la DP antes: ".
            $difundido_DP_anterior.
            ", difundido por la DP ahora: ".
            $difundido_DP.
            ", de la Institución que antes era: ".
            $institucion_anterior. 
            ", por la nueva Institución: ".
            $institucion. 
            " del curso ID que antes era: ".
            $identificador_curso_anterior.
            " por el nuevo curso ID: ".
            $cursos->identificador_curso.
            " de la modalidad que antes era: " .
            $modalidad_anterior.
            " por la nueva modalidad de: " .
            $cursos->modalidad;
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
            'instituciones.id',
            'instituciones.nombre',
            'instituciones.tipo',
            'instituciones.siglas'
        )
        ->orderBy("id")
        ->get();
        return $instituciones; 

    }

    public function validar($id){
        $curso = Curso::find($id);
        if($curso->estatus_id == 1){
            $curso->estatus_id = 2;
            $curso->save();
            return ("Curso validado con éxito");
        }else{
            return ("Error desde el controller");
            //mensaje del fracaso de la finalización
        }
    }
}
