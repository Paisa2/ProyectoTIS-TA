<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\EmitirInformeController;
use App\Models\Solicitud_adquisicion;
use Illuminate\Support\Facades\DB;
use App\Models\InfoComparativo;
use App\Models\InformeAutorizacion;


class EmitirInformeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $informe=InformeAutorizacion::where('id',$id)->first();
        
        if($informe){
            $comparativo=InfoComparativo::where('id',$informe->comparativo_id)->first();
            $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
            
            
            return view( 'EmitirInforme.DetalleInforme', compact('meses', 'comparativo','informe'));

 
        }else{
           abort(404); 
        }
        
       
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
    public function store(Request $request, $id)
    {
        $mensajes = [
            
            'min'   => 'El :attribute debe tener por lo menos :min caracteres.',
          
        ];
        $this->validate($request, [
            'tipo'=>['required'], 
            'justificacion'=>['required','min:20'],
            ], $mensajes);
        $informe=new InformeAutorizacion;
        $informe->comparativo_id=$id;
        $informe->tipo_informe=$request->tipo;
        $informe->justificacion_informe=$request->justificacion;
        if($request->tipo=='Aceptado'){
            $informe->empresa_seleccionada=$request->empresa;
        }
          if($request->formato){
            $informe->con_formato=true;
          }else{
            $informe->con_formato=false;   
          }
        
        $informe->save();
        return redirect()->route('bienvenido');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function emitirinforme($id)
    {
        $comparativo=InfoComparativo::where('id',$id)->first();
        if($comparativo){
            $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
            
            
            return view( 'EmitirInforme.EmitirInforme', compact('meses', 'comparativo'));

 
        }else{
           abort(404); 
        }
        
       
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
