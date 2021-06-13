<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComparativoCotizacion;
use App\Models\Infojefeunidad;
use App\Models\InfoCotizacion;
use App\Models\InfoComparativo;
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
        $datoscomparativo=InfoComparativo::where("id",$id)->first();
        if($datoscomparativo){
            $datos=json_decode($datoscomparativo->detalle_comparativo, true);      
            $propuestas=[];
            //echo dd($datoscomparativo);                     
            foreach($datos as $columna){
                array_push($propuestas,array_values($columna));
            }
            return view("COMPARATIVO.comparativo", compact("datoscomparativo","propuestas"));
        }
        else{
            abort(404);
        }
           
    }
    public function generar($id){
        $cotizacion=InfoCotizacion::where("id",$id)->first();
        $respuestas=RespuestaCotizacion::where("cotizacion_id",$id)->get();
        $detalles=json_decode($cotizacion->detalle_cotizacion,true);
        $contador=0;
        $totales=[];
        $empresas=[];
        foreach($respuestas as $respuesta)
        {
            $precios=json_decode($respuesta->detalle_precios,true)["total"];
            $detalles["precios".$contador]=$precios;
            array_push($totales,array_sum($precios));
            array_push($empresas,$respuesta->razon_social);
            $contador=$contador+1;
        }
        $preciomenor=min($totales);
        $recomendada=$empresas[array_search($preciomenor,$totales,true)];
        $comparativo=new ComparativoCotizacion;
        $comparativo->detalle_comparativo=json_encode($detalles);
        $comparativo->empresa_recomendada=$recomendada;
        $comparativo->cotizacion_id=$id;
        $comparativo->tecnico_responsable_id=session("id");
        $comparativo->jefe_administrativo_id=Infojefeunidad::where("unidad_id",session("unidad_id"))->first()->usuario_id;
        $comparativo->jefe_unidad_id=Infojefeunidad::where("unidad_id",$cotizacion->unidad_solicitante_id)->first()->usuario_id;
        $comparativo->save();
        return redirect()->route("comparativo.create",$comparativo->id);
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
        return view("COMPARATIVO.comparativo", compact("clave"));
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
