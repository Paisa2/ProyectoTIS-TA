<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function index(){
     //return view('uppdf.subirpdf');
     return \View::make('uppdf.subirpdf');
    }

    //public function mguardar(Request $request){
     //   dd($request);
    //}


    public function save(Request $request){

       //obtenemos el campo file definido en el formulario
       $file = $request->file('file');

       //obtenemos el nombre del archivo
       $nombre = $file->getClientOriginalName();

       //indicamos que queremos guardar un nuevo archivo en el disco local
       \Storage::disk('local')->put($nombre,  \File::get($file));

       //return "archivo guardado";
       return redirect()->route('formulario')->with('confirm', 'El archivo a sido guardado correctamente');
       }
}
