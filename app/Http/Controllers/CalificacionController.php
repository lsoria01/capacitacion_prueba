<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalificacionController extends Controller
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
        $calificaciones = DB::table ('calificaciones')
        ->join('usuarios', 'calificaciones.usuario_id', "=" , "usuarios.id")
        ->join('personas', 'usuarios.persona_id', 'personas.id')
        ->join('cursos', 'calificaciones.curso_id', "=", "cursos.id")
        ->join('estatus', 'calificaciones.estatus_id', '=', 'estatus.id')
        ->join('instituciones', 'cursos.institucion_id', "=", "instituciones.id" )
        ->select(
            'calificaciones.id',
            DB::raw("CONCAT(personas.nombres,' ',personas.apellido_pat,' ',personas.apellido_mat) AS usuario_id"),
            'cursos.nombre as curso_id',
            'cursos.curso_oblig as curso_oblig',
            'cursos.hrs_cap as hrs_cap',
            'cursos.modalidad as modalidad',
            'calificaciones.curso_fin',
            'calificaciones.aprobado',
            'calificaciones.calif',
            'calificaciones.fecha',
            'calificaciones.anio',
            'calificaciones.rechazo',
            'calificaciones.url_constancia',
            'estatus.nombre as estatus_id',
            //datos de la tabla curso
            'instituciones.nombre as institucion_id',   
        )
        ->orderBy("id")
        ->get();
        return $calificaciones;
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
        $calificaciones = new Calificacion();
        $calificaciones-> usuario_id = $request->usuario_id;
        $calificaciones-> curso_id = $request->curso_id;
        $calificaciones-> curso_fin = $request->curso_fin;
        $calificaciones-> aprobado = $request->aprobado;
        $calificaciones-> calif = $request->calif;
        $calificaciones-> fecha = $request->fecha;
        $calificaciones-> anio = $request->anio;   
        /* if($request->cursoIntExt == 0){
            $calificaciones-> institucion_id = 1;
        }
        else{
            $calificaciones-> institucion_id = $request->institucion_id;
        }    */     
        try{
            if($request->hasFile('file')){
                $file = $request->file('file');
                $request->validate([
                     'file' => 'required|mimes:pdf|max:10240'
                    ]);
                $nombre_constancia = $file->getClientOriginalName();
                $calificaciones->nombre_constancia = $nombre_constancia;
                $url = $file->store('public/constancias');
                $storage = 'storage';
                $public = 'public';
                $calificaciones->url_constancia = str_replace($public, $storage, $url);
            }

        }catch(\Exception $e){
            return response()->json([
                'message'=>$e->getMessage()
            ]);
        }
        $calificaciones-> estatus_id = $request->estatus_id;
        $calificaciones->save();
        return $calificaciones;

        /* if($request->hasFile('archivo')){
            
            $calificaciones = new Calificacion();
            $calificaciones-> urlConstancia = $request->archivo->getClientOriginalName();
            $calificaciones->save();
            info($urlConstancia); //log
        } */

        /* return response()->json([
            'message' => 'ok'
        ]); */
        //$file = $request->file('file');

        /* ******  Esto funciona ******* */

        /* try{
            if($request->hasFile('file')){
                $calificaciones = new Calificacion();
                $file = $request->file('file');
                $nombre_constancia = $file->getClientOriginalName();
                $calificaciones->nombre_constancia = $nombre_constancia;
                $file_name = time(). '-' . $file->getClientOriginalName();
                $calificaciones->urlConstancia = $file->store('public/constancias');
                $calificaciones->save();            
                $file->move(public_path('image'), $nombre_constancia);
                return response()->json([
                    'message'=>'File uploaded successfully!'
                ], 200);
            }
            }catch(\Exception $e){
                return response()->json([
                    'message'=>$e->getMessage()
                ]);
            } */
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
        $calificaciones = Calificacion::find($id);
        $calificaciones-> rechazo = $request->rechazo;
        $calificaciones-> estatus_id = 3;
        $calificaciones->save();

        return $calificaciones;
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

    public function validar($id){
        $calificacion = Calificacion::find($id);
        if($calificacion->estatus_id == 1){
            $calificacion->estatus_id = 2;
            $calificacion->save();
            return ("Curso validado con éxito");
        }else{
            return ("Error desde el controller");
            //mensaje del fracaso de la finalización
        }
    }

    public function rechazar(Request $request, $id)
    {
        $calificaciones = Calificacion::find($id);
        $calificaciones-> rechazo = $request->rechazo;
        $calificaciones-> estatus_id = 3;
        $calificaciones->save();

        return $calificaciones;
    }
        

    public function califAuth(){

        $calificaciones = DB::table ('calificaciones')
        ->join('usuarios', 'calificaciones.usuario_id', "=" , 'usuarios.id')
        ->join('personas', 'usuarios.persona_id', "=" , 'personas.id')
        ->join('cursos', 'calificaciones.curso_id', "=", "cursos.id")
        ->join('estatus', 'calificaciones.estatus_id', '=', 'estatus.id')
        ->join('instituciones', 'cursos.institucion_id', "=", "instituciones.id" )
        ->select(
            'calificaciones.id',
            DB::raw("CONCAT(personas.nombres,' ',personas.apellido_pat,' ',personas.apellido_mat) AS usuario_id"),
            'cursos.nombre as curso_id',
            'calificaciones.curso_fin',
            'calificaciones.aprobado',
            'calificaciones.calif',
            'calificaciones.fecha',
            'calificaciones.anio',
            'calificaciones.rechazo',
            'calificaciones.url_constancia',
            'calificaciones.nombre_constancia',
            'estatus.nombre as estatus_id',
            //datos de la tabla curso
            'instituciones.nombre as institucion_id',
            'cursos.hrs_cap as hrs_cap',
            'cursos.modalidad as modalidad',
            'cursos.curso_oblig as curso_oblig',
            'cursos.fecha_fin as fecha_fin'
        )
        ->where('usuarios.id', Auth::user()->id)
        ->orderBy("id")
        ->get();
        return $calificaciones;
    }

    public function califKardex(){

        $calificaciones = DB::table ('calificaciones')
        ->join('usuarios', 'calificaciones.usuario_id', "=" , "usuarios.id")
        ->join('personas', 'usuarios.persona_id', "=" , 'personas.id')
        ->join('cursos', 'calificaciones.curso_id', "=", "cursos.id")
        ->join('estatus', 'calificaciones.estatus_id', '=', 'estatus.id')
        ->join('instituciones', 'cursos.institucion_id', "=", "instituciones.id" )
        ->select(
            'calificaciones.id',
            DB::raw("CONCAT(personas.nombres,' ',personas.apellido_pat,' ',personas.apellido_mat) AS usuario_id"),
            'cursos.nombre as curso_id',
            'calificaciones.curso_fin',
            'calificaciones.aprobado',
            'calificaciones.calif',
            'calificaciones.fecha',
            'calificaciones.anio',
            'calificaciones.rechazo',
            'calificaciones.url_constancia',
            'calificaciones.nombre_constancia',
            'estatus.nombre as estatus_id',
            //datos de la tabla curso
            'instituciones.nombre as institucion_id',
            'cursos.hrs_cap as hrs_cap',
            'cursos.modalidad as modalidad',
            'cursos.curso_oblig as curso_oblig',
            'cursos.fecha_fin as fecha_fin'
        )
        ->where([
            ['usuarios.id', Auth::user()->id],
            ['calificaciones.estatus_id' , '=', 2]
        ])
        ->orderBy("id")
        ->get();
        return $calificaciones;
    }
}
