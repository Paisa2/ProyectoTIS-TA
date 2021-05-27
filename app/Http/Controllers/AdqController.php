<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdquisicionRequest;
use App\Models\Solicitud_adquisicion;
use App\Models\ItemGasto;
use Illuminate\Http\Request;

class AdqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tipo1 = $request->get('todos');
        $tipo2 = $request->get('compra');
        $tipo3 = $request->get('alquiler');
        // $todos=Solicitud_adquisicion::all();
        $solicitudes=Solicitud_adquisicion::where('tipo_solicitud_a', 'like', "%$tipo2%")->where('tipo_solicitud_a', 'like', "%$tipo3%")->get();
        return view('solicitudes-adq.lista', compact('solicitudes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $adquisicion=ItemGasto::where('tipo_item', '=', 'Especifico')->get();
        return view('solicitudes-adq.solicitud', compact('adquisicion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdquisicionRequest $request)
    {
        $solicitudes = new Solicitud_adquisicion;
        $solicitudes->tipo_solicitud_a = $request->tipo;
        $solicitudes->estado_solicitud_a = 'pendiente';
        $solicitudes->justificacion_solicitud_a = $request->justificacion;
        $solicitudes->detalle_solicitud_a = $request->detalle;
        $solicitudes->fecha_entrega = $request->fecha;
        $solicitudes->de_usuario_id = session('id');
        $solicitudes->para_unidad_id = session('administrativa_id');
        $solicitudes->save();
        return redirect('lista')->with('confirm', 'Solicitud de adquisición Enviada');
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
