<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use Illuminate\Support\Facades\Auth;

class CalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calificaciones = Calificacion::leftJoin('curso', 'calificacion.curso', '=', 'curso.id_curso')
        ->leftJoin('users', 'calificacion.empleado', '=', 'users.id')
        ->leftJoin('institucion', 'calificacion.id_institucion', '=', 'institucion.id_institucion')
        ->leftJoin('estatus', 'calificacion.id_estatus', '=', 'estatus.id_estatus')
        ->select([
            'calificacion.id_calificacion',
            'users.name as empleado',
            'curso.nombre as curso',
            'calificacion.cursoFin',
            'calificacion.aprobado',
            'calificacion.cursoOblig',
            'calificacion.calif',
            'calificacion.hrsCap',
            'calificacion.fecha',
            'calificacion.anio',
            'calificacion.cursoIntExt',
            'institucion.siglas as id_institucion',
            'calificacion.difundidoDP',
            'calificacion.modalidad',
            'calificacion.urlConstancia',
            'estatus.nombre as id_estatus'          
        ])
        ->orderBy("id_calificacion")
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
        $calificaciones-> empleado = $request->empleado;
        $calificaciones-> curso = $request->curso;
        $calificaciones-> cursoFin = $request->cursoFin;
        $calificaciones-> aprobado = $request->aprobado;
        $calificaciones-> cursoOblig = $request->cursoOblig;
        $calificaciones-> calif = $request->calif;
        $calificaciones-> hrsCap = $request->hrsCap;
        $calificaciones-> fecha = $request->fecha;
        $calificaciones-> anio = $request->anio;
        $calificaciones-> cursoIntExt = $request->cursoIntExt;
        if($request->cursoIntExt == 0){
            $calificaciones-> id_institucion = 1;
        }
        else{
            $calificaciones-> id_institucion = $request->id_institucion;
        }        
        $calificaciones-> difundidoDP = $request->difundidoDP;
        $calificaciones-> modalidad = $request->modalidad;
        try{
            if($request->hasFile('file')){
                $file = $request->file('file');
                $request->validate([
                     'file' => 'required|mimes:pdf|max:10240'
                    ]);
                $nombreConstancia = $file->getClientOriginalName();
                $calificaciones->nombreConstancia = $nombreConstancia;
                $url = $file->store('public/constancias');
                $storage = 'storage';
                $public = 'public';
                $calificaciones->urlConstancia = str_replace($public, $storage, $url);
            }

        }catch(\Exception $e){
            return response()->json([
                'message'=>$e->getMessage()
            ]);
        }
        $calificaciones-> id_estatus = $request->id_estatus;
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
                $nombreConstancia = $file->getClientOriginalName();
                $calificaciones->nombreConstancia = $nombreConstancia;
                $file_name = time(). '-' . $file->getClientOriginalName();
                $calificaciones->urlConstancia = $file->store('public/constancias');
                $calificaciones->save();            
                $file->move(public_path('image'), $nombreConstancia);
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

    public function validar($id_calificacion){
        $calificacion = Calificacion::find($id_calificacion);
        if($calificacion->id_estatus == 1){
            $calificacion->id_estatus = 2;
            $calificacion->save();
            return ("Curso validado con éxito");
        }else{
            return ("Error desde el controller");
            //mensaje del fracaso de la finalización
        }
    }

    public function califAuth(){
        $calificaciones = Calificacion::leftJoin('curso', 'calificacion.curso', '=', 'curso.id_curso')
        ->leftJoin('users', 'calificacion.empleado', '=', 'users.id')
        ->leftJoin('institucion', 'calificacion.id_institucion', '=', 'institucion.id_institucion')
        ->leftJoin('estatus', 'calificacion.id_estatus', '=', 'estatus.id_estatus')
        ->select([
            'calificacion.id_calificacion',
            'users.name as empleado',
            'curso.nombre as curso',
            'calificacion.cursoFin',
            'calificacion.aprobado',
            'calificacion.cursoOblig',
            'calificacion.calif',
            'calificacion.hrsCap',
            'calificacion.fecha',
            'calificacion.anio',
            'calificacion.cursoIntExt',
            'institucion.siglas as id_institucion',
            'calificacion.difundidoDP',
            'calificacion.modalidad',
            'calificacion.urlConstancia',
            'estatus.nombre as id_estatus'          
        ])
        ->where('users.id', Auth::user()->id)
        ->orderBy("id_calificacion")
        ->get();
        return $calificaciones;
    }
}
