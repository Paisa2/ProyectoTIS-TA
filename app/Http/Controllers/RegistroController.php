<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessaggeRequest;
use App\Models\Unidad;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$unidades = Unidad::where('tipo_unidad', 'Institución')->orWhere('tipo_unidad', 'facultad')->get();*/
        $facultades = Unidad::where('tipo_unidad', 'facultad')->get();
        $instituciones = Unidad::where('tipo_unidad', 'Institución')->get();
        return view('registro', compact('facultades', 'instituciones'));
        //
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
    public function store(MessaggeRequest $request)
    {
        $unidad = new Unidad;
        $unidad->tipo_unidad = $request->tipo_unidad;
        $unidad->nombre_unidad = $request->nombre_unidad;
        $unidad->unidad_id = $request->unidad_id;        
        $unidad->save();
        return redirect('unidades')->with('confirm', 'La unidad se registro correctamente');
        //
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
}
