<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nombramiento;
use Illuminate\Support\Str;

class NombramientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nombramientos = Nombramiento::leftJoin('users', 'nombramiento.id_user', '=', 'users.id')
        ->select([
            'nombramiento.id_nombramiento',
            'users.nombreCompleto as id_user',
            'nombramiento.tipo',
            'nombramiento.fecEmis',
            'nombramiento.fecRatif'
        ])
        ->orderBy("id_nombramiento")
        ->get();
        return $nombramientos;
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
        $nombramientos = new Nombramiento();
        $nombramientos->id_user = $request->id_user;
        $nombramientos->tipo = Str::upper($request->tipo);
        $nombramientos->fecEmis = $request->fecEmis;
        $nombramientos->fecRatif = $request->fecRatif;
        $nombramientos->save();
        return $nombramientos;
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
    public function update(Request $request, $id_nombramiento)
    {
        $nombramientos = Nombramiento::find($id_nombramiento);
        $nombramientos->id_user = $request->id_user;
        $nombramientos->tipo = Str::upper($request->tipo);
        $nombramientos->fecEmis = $request->fecEmis;
        $nombramientos->fecRatif = $request->fecRatif;
        $nombramientos->save();
        return $nombramientos;
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
}
