<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\CotizacionPdf;
use App\Models\Solicitud_cotizacion;
use App\Models\RespuestaCotizacion;

class StorageController extends Controller
{
    public function index($id){
    $cotizaciones = RespuestaCotizacion::join('solicitudes_cotizaciones', 'solicitudes_cotizaciones.id', '=', 'respuestas_cotizacion.cotizacion_id')
    ->select('respuestas_cotizacion.*', 'solicitudes_cotizaciones.codigo_cotizacion')
    ->where('respuestas_cotizacion.id',$id)->get();
    return view('uppdf.subirpdf', compact('cotizaciones'));
     //return \View::make('uppdf.subirpdf');
    }

    //public function mguardar(Request $request){
     //   dd($request);
    //}


    public function save(Request $request, $valor){
        $cotizacion = RespuestaCotizacion::join('solicitudes_cotizaciones', 'solicitudes_cotizaciones.id', '=', 'respuestas_cotizacion.cotizacion_id')
        ->select('solicitudes_cotizaciones.*')
        ->where('respuestas_cotizacion.id',$valor)->first();
        $mensajes = [
            'ruta.required' => 'Debe de seleccionar y agregar un documento PDF',
            'mimetypes' => 'ERROR.  Solo se aceptan documentos con extension PDF',
            'numeric'=> 'ERROR.  El codigo de la cotizacion es incorrecto',
        ];
        $this->validate($request, [
            'ruta'=>['required','mimetypes:application/pdf'],
            'cotizacion_id'=>'numeric',
            ], $mensajes);

       //obteniendo el campo file definido en el formulario
       $file = $request->file('ruta');

       //obteniendo el nombre del archivo
       $nombre = $file->getClientOriginalName();

       //indicando que se quiere guardar un nuevo archivo en el disco local
       \Storage::disk('local')->put($nombre,  \File::get($file));
       $rutaaa="storage/".$nombre;
       $datospdf=new CotizacionPdf;
       $datospdf->ruta=$rutaaa;
       //$datospdf->cotizacion_id=$request->cotizacion_id;
       $datospdf->resp_cot_id=$valor;
       $datospdf->save();

       //return "archivo guardado";
       return redirect()->route("respuestasCotizacion.index", $cotizacion->id)->with('confirm', 'Se ha agregado el archivo PDF correctamente');
       }
}
