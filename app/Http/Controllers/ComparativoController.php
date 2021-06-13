<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComparativoCotizacion;
use App\Models\Infojefeunidad;
use App\Models\InfoCotizacion;
use App\Models\RespuestaCotizacion;

class ComparativoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $cotizacion=InfoCotizacion::where("id",$id)->first();
        $respuestas=RespuestaCotizacion::where("cotizacion_id",$id)->get();
        $detalles=json_decode($cotizacion->detalle_cotizacion,true);
        $contador=0;
        foreach($respuestas as $respuesta){
            $detalles["precios".$contador]=json_decode($respuestas->precios,true)["total"];
            $contador=$contador+1;
        }
        $comparativo=new ComparativoCotizacion;
        $comparativo->detalle_comparativo=$detalles;
        $comparativo->empresa_recomendada="comteco";
        $comparativo->cotizacion_id=$id;
        $comparativo->tecnico_responsable_id=session("id");
        $comparativo->jefe_administrativo_id=Infojefeunidad::where("unidad_id",session("unidad_id"))->first()->usuario_id;
        $comparativo->jefe_unidad_id=InfoCotizacion::where("unidad_id",$cotizacion->unidad_solicitante_id)->first()->usuario_id;
        $comparativo->save();
        return view("COMPARATIVO.comparativo");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         
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
