<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Solicitud_cotizacion;
use App\Models\RespuestaCotizacion;
use App\Models\InfoCotizacion;
use App\Models\TodaEmpresa;
use App\Models\CotizacionPdf;

class RespuestasCotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $cotizaciones=InfoCotizacion::join("respuestas_cotizacion","respuestas_cotizacion.cotizacion_id","=","info_cotizacion.id")
        ->where('info_cotizacion.id', $id)
        ->select("info_cotizacion.*","respuestas_cotizacion.razon_social","respuestas_cotizacion.id as resp_cot_id")
        ->orderBy('created_at', 'desc')->get();
        foreach ($cotizaciones as $cotizacion) {
            $pdf = CotizacionPdf::where('resp_cot_id', $cotizacion->resp_cot_id)->first();
            if($pdf) {
                $cotizacion->pdf_ruta = $pdf->ruta; 
            }
        }
        return view("respuestasCotizacion.visualizarRespuestas", compact("cotizaciones"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $cotizacion=Solicitud_cotizacion::where('id',$id)->first();
        if($cotizacion){
            $datos=json_decode($cotizacion->detalle_cotizacion, true);      
            $detalles=[];                     
            foreach($datos as $columna){
                array_push($detalles,array_values($columna));
            };
        }
        else{
            abort(404);
        }
        //echo dd($detalles);
        $empresas = DB::table(DB::raw('(select * from toda_empresa except select razon_social as nombre_empresa from respuestas_cotizacion where cotizacion_id = ' . $id . ') as em'))
        ->orderBy('nombre_empresa', 'asc')->get();
        return view("respuestasCotizacion.crearRespuestasCotizacion", compact("cotizacion","detalles", "empresas"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $mensages = [
            'required' => 'El campo :attribute es requerido',
            'min'   => 'Introducir mínimo :min caracteres',
            'max'   => 'Introducir máximo :max caracteres',
            'regex' => 'El campo :attribute solo puede tener letras',            
        ];
        $this->validate($request, [
            'razon_social'=>['required', 'min:2', 'max:40', 'regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ-]))+$/'],
            ], $mensages);
        
        $respuesta=new RespuestaCotizacion;
        $respuesta->cotizacion_id=$id;
        $respuesta->razon_social=$request->razon_social;
        $respuesta->detalle_precios=json_encode($request->detalles);
        $respuesta->save();
        return redirect()->route("solicitudCotizacion.index")->with ("confirm", "Se registró correctamente");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cotizacion=InfoCotizacion::join("respuestas_cotizacion","respuestas_cotizacion.cotizacion_id","=","info_cotizacion.id")->where('respuestas_cotizacion.id', $id)
        ->select("info_cotizacion.*","respuestas_cotizacion.razon_social","respuestas_cotizacion.id as resp_cot_id","respuestas_cotizacion.detalle_precios")->first();
        if($cotizacion){
            $datos=json_decode($cotizacion->detalle_cotizacion, true);      
            $detalles=[];                     
            foreach($datos as $columna){
                array_push($detalles,array_values($columna));
            };
            $datos2=json_decode($cotizacion->detalle_precios, true);      
            $precios=[];                     
            foreach($datos2 as $columna){
                array_push($precios,array_values($columna));
            };
        }
        else{
            abort(404);
        }
        //echo dd($detalles);
        return view("respuestasCotizacion.detallesRespuesta", compact("cotizacion","detalles","precios"));
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
