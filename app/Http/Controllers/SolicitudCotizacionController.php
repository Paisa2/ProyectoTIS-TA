<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Solicitud_cotizacion;
use App\Models\Solicitud_adquisicion;
use App\Models\CotizacionPdf;
use App\Models\RespuestaCotizacion;

class SolicitudCotizacionController extends Controller
{
    public function index(){
        $cotizaciones = Solicitud_cotizacion::all();
        foreach($cotizaciones as $cotizacion){
        //    $cotizacion->pdf=CotizacionPdf::where('cotizacion_id',$cotizacion->id)->count();
        //    if($cotizacion->pdf > 0){
        //        $cotizacion->pdf_ruta=CotizacionPdf::where('cotizacion_id',$cotizacion->id)->first()->ruta;
        //    }
        $cotizacion->respuestas=RespuestaCotizacion::where('cotizacion_id',$cotizacion->id)->count();

        }
        return view("SolicitudCotizacion.visualizarSolicitudCotizacion", compact("cotizaciones"));
    }

    public function create(){
        return view("SolicitudCotizacion.crearSolicitudCotizacion");
    }

    public function store(Request $request)
    {
        $mensages = [
            'required' => 'El campo :attribute es requerido',
            'min'   => 'Introducir mínimo :min caracteres',
            'max'   => 'Introducir máximo :max caracteres',
            'regex' => 'El campo :attribute solo puede tener letras',
            'numero_cotizacion.numeric' => 'El campo Número Cotización solo puede tener números',
            'numero_cotizacion.digits_between'   => 'Número Cotización debe tener entre 6 y 8 dígitos',
        ];
        $this->validate($request, [
            //'razon_social'=>['required', 'min:2', 'max:40', 'regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ-]))+$/'],
            'numero_cotizacion'=>['required', 'digits_between:6,8', 'numeric'], 
            'fecha_cotizacion'=>['required'],
            ], $mensages);
        $cotizacion = new Solicitud_cotizacion;    
        $cotizacion->codigo_cotizacion = $request->numero_cotizacion;
        $cotizacion->fecha_cotizacion = $request->fecha_cotizacion;
        $cotizacion->detalle_cotizacion = json_encode ($request->detalles);

        $cotizacion->save();
        return redirect()->route('solicitudCotizacion.index')->with('confirm', 'Nuevo usuario registrado correctamente');           

    }
    public function show($id){
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
        return view("SolicitudCotizacion.detallesCotizacion", compact("cotizacion","detalles"));
    }
    public function generar($id){
        $adquisicion = Solicitud_adquisicion::where("id",$id)->first();
        if($adquisicion){
            $cotizacion = new Solicitud_cotizacion;    
            $cotizacion->codigo_cotizacion = $adquisicion->codigo_solicitud_a;
            $cotizacion->fecha_cotizacion = date("Y-m-d");
            $cotizacion->solicitud_a_id = $id;
            $jason = json_decode($adquisicion->detalle_solicitud_a,true);
            $detalle = array();
            $detalle['numero'] = $jason['numero'];
            $detalle['cantidad'] = $jason['cantidad'];
            $detalle['unidad'] = $jason['unidad'];
            $detalle['articulo'] = $jason['articulo'];
            $cotizacion->detalle_cotizacion = json_encode ($detalle);
    
            $cotizacion->save();
            return redirect()->route('solicitudCotizacion.show',$cotizacion->id);
        }
        
    }
}
