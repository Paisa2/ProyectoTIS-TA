<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Solicitud_cotizacion;
use App\Models\Solicitud_adquisicion;
use App\Models\CotizacionPdf;
use App\Models\RespuestaCotizacion;
use App\Models\ComparativoCotizacion;
use App\Models\TodaEmpresa;
use Barryvdh\DomPDF\Facade as PDF;

class SolicitudCotizacionController extends Controller
{
    public function index(){
        $cotizaciones = Solicitud_cotizacion::join('solicitudes_adquisiciones', 'solicitudes_adquisiciones.id', '=', 'solicitudes_cotizaciones.solicitud_a_id')
        ->where('solicitudes_adquisiciones.para_unidad_id', session('unidad_id'))
        ->select('solicitudes_cotizaciones.*')->get();
        foreach($cotizaciones as $cotizacion){
            $cotizacion->comparativo=ComparativoCotizacion::where('cotizacion_id',$cotizacion->id)->count();
            if($cotizacion->comparativo > 0){
                $cotizacion->comparativo_id=ComparativoCotizacion::where('cotizacion_id',$cotizacion->id)->first()->id;
            }
        $cotizacion->respuestas=RespuestaCotizacion::where('cotizacion_id',$cotizacion->id)->count();
        }
        $empresas = TodaEmpresa::all();
        return view("SolicitudCotizacion.visualizarSolicitudCotizacion", compact("cotizaciones", "empresas"));
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
            $detalle['detalle'] = $jason['detalle'];
            $cotizacion->detalle_cotizacion = json_encode ($detalle);
    
            $cotizacion->save();
            return redirect()->route('solicitudCotizacion.show',$cotizacion->id);
        }
        
    }

    public function generarPdf(Request $request){
        if($request->razon_social){
            $empresa = $request->razon_social;
        }else{
            $empresa = '';
        }
        $cotizacion = Solicitud_cotizacion::where('id', $request->cotizacion_id)->first();
        if($cotizacion){
            $datos = json_decode($cotizacion->detalle_cotizacion, true);
            $detalles['numero'] = array_values($datos['numero']);                   
            $detalles['cantidad'] = array_values($datos['cantidad']);                   
            $detalles['unidad'] = array_values($datos['unidad']);                   
            $detalles['detalle'] = array_values($datos['detalle']); 
            $pdf = PDF::loadView('modelosPdf.cotizacionImpresion', compact('cotizacion', 'detalles', 'empresa'))->setPaper('letter', 'landscape');
        }else{
            abort(404);
        }
        return $pdf->stream();
    }
}
