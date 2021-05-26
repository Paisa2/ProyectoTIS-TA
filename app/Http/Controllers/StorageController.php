<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Cotizacion_pdf;
use App\Models\Solicitud_cotizacion;

class StorageController extends Controller
{
    public function index($id){
    $cotizaciones = Solicitud_cotizacion::where('id',$id)->get();
    return view('uppdf.subirpdf', compact('cotizaciones'));
     //return \View::make('uppdf.subirpdf');
    }

    //public function mguardar(Request $request){
     //   dd($request);
    //}


    public function save(Request $request, $valor){
        $mensajes = [
            'ruta.required' => 'Debe de seleccionar y agregar un documento PDF',
            'mimetypes' => 'ERROR.  Solo se aceptan documentos con extension PDF',
            'numeric'=> 'ERROR.  El ID de la cotizacion es incorrecto',
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
       $datospdf=new Cotizacion_pdf;
       $datospdf->ruta=$rutaaa;
       $datospdf->cotizacion_id=$request->cotizacion_id;
       $datospdf->cotizacion_id=$request->cotizacion_id;
       $datospdf->save();

       //return "archivo guardado";
       return redirect()->route('formulario', $request->cotizacion_id)->with('confirm', 'El archivo a sido guardado correctamente');
       }
}
