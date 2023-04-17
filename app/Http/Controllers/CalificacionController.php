<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $calificaciones = Calificacion::leftJoin('curso', 'calificacion.id_curso', '=', 'curso.id_curso')
        ->leftJoin('users', 'calificacion.id_user', '=', 'users.id')
        ->leftJoin('estatus', 'calificacion.id_estatus', '=', 'estatus.id_estatus')
        ->select([
            'calificacion.id_calificacion',
            'users.name as id_user',
            'curso.nombre as id_curso',
            'curso.cursoOblig as cursoOblig',
            'curso.hrsCap as hrsCap',
            'curso.modalidad as modalidad',
            'calificacion.cursoFin',
            'calificacion.aprobado',
            'calificacion.calif',
            'calificacion.fecha',
            'calificacion.anio',
            'calificacion.rechazo',
            'calificacion.urlConstancia',
            'estatus.nombre as id_estatus'          
        ])
        ->orderBy("id_calificacion")
        ->get();
        return $calificaciones; */

        $calificaciones = DB::table ('calificacion')
        ->join('users', 'calificacion.id_user', "=" , "users.id")
        ->join('curso', 'calificacion.id_curso', "=", "curso.id_curso")
        ->join('estatus', 'calificacion.id_estatus', '=', 'estatus.id_estatus')
        ->join('institucion', 'curso.id_institucion', "=", "institucion.id_institucion" )
        ->select(
            'calificacion.id_calificacion',
            'users.name as id_user',
            'curso.nombre as id_curso',
            'curso.cursoOblig as cursoOblig',
            'curso.hrsCap as hrsCap',
            'curso.modalidad as modalidad',
            'calificacion.cursoFin',
            'calificacion.aprobado',
            'calificacion.calif',
            'calificacion.fecha',
            'calificacion.anio',
            'calificacion.rechazo',
            'calificacion.urlConstancia',
            'estatus.nombre as id_estatus',   
            //datos de la tabla curso
            'institucion.descripcion as id_institucion',
        )
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
        $calificaciones-> id_user = $request->id_user;
        $calificaciones-> id_curso = $request->id_curso;
        $calificaciones-> cursoFin = $request->cursoFin;
        $calificaciones-> aprobado = $request->aprobado;
        $calificaciones-> calif = $request->calif;
        $calificaciones-> fecha = $request->fecha;
        $calificaciones-> anio = $request->anio;   
        /* if($request->cursoIntExt == 0){
            $calificaciones-> id_institucion = 1;
        }
        else{
            $calificaciones-> id_institucion = $request->id_institucion;
        }    */     
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
    public function update(Request $request, $id_calificacion)
    {
        $calificaciones = Calificacion::find($id_calificacion);
        $calificaciones-> rechazo = $request->rechazo;
        $calificaciones-> id_estatus = 3;
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

    public function rechazar(Request $request, $id_calificacion)
    {
        $calificaciones = Calificacion::find($id_calificacion);
        $calificaciones-> rechazo = $request->rechazo;
        $calificaciones-> id_estatus = 3;
        $calificaciones->save();

        return $calificaciones;
    }
        

    public function califAuth(){

        $calificaciones = DB::table ('calificacion')
        ->join('users', 'calificacion.id_user', "=" , "users.id")
        ->join('curso', 'calificacion.id_curso', "=", "curso.id_curso")
        ->join('estatus', 'calificacion.id_estatus', '=', 'estatus.id_estatus')
        ->join('institucion', 'curso.id_institucion', "=", "institucion.id_institucion" )
        ->select(
            'calificacion.id_calificacion',
            'users.name as id_user',
            'curso.nombre as id_curso',
            'calificacion.cursoFin',
            'calificacion.aprobado',
            'calificacion.calif',
            'calificacion.fecha',
            'calificacion.anio',
            'calificacion.rechazo',
            'calificacion.urlConstancia',
            'calificacion.nombreConstancia',
            'estatus.nombre as id_estatus',
            //datos de la tabla curso
            'institucion.descripcion as id_institucion',
            'curso.hrsCap as hrsCap',
            'curso.modalidad as modalidad',
            'curso.cursoOblig as cursoOblig',
            'curso.fecha_fin as fecha_fin'
        )
        ->where('users.id', Auth::user()->id)
        ->orderBy("id_calificacion")
        ->get();
        return $calificaciones;


        /* $calificaciones = Calificacion::leftJoin('curso', 'calificacion.id_curso', '=', 'curso.id_curso')
        ->leftJoin('users', 'calificacion.id_user', '=', 'users.id')
        ->leftJoin('estatus', 'calificacion.id_estatus', '=', 'estatus.id_estatus')
        ->select([
            'calificacion.id_calificacion',
            'users.name as id_user',
            'curso.nombre as id_curso',
            'calificacion.cursoFin',
            'calificacion.aprobado',
            'calificacion.calif',
            'calificacion.fecha',
            'calificacion.anio',
            'calificacion.rechazo',
            'calificacion.urlConstancia',
            'calificacion.nombreConstancia',
            'estatus.nombre as id_estatus',
            //datos de la tabla curso
            'curso.hrsCap as hrsCap',
            'curso.cursoOblig as cursoOblig',  
            'curso.id_institucion as id_institucion',
            'curso.modalidad as modalidad',
            'curso.fecha_fin as fecha_fin'
        ])
        ->where('users.id', Auth::user()->id)
        ->orderBy("id_calificacion")
        ->get(); */

        /* $calificaciones = Curso::leftJoin('institucion', 'curso.id_institucion', '=', 'institucion.id_institucion')
        ->select([
            'institucion.descripcion as id_institucion'
        ])
        ->orderBy("id_curso")
        ->get();
        return $calificaciones; */
    }
}
