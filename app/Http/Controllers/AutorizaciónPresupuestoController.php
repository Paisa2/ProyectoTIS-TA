<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AutorizaciónPresupuestoController;
use App\Models\Solicitud_adquisicion;
use App\Models\Presupuesto;
use Illuminate\Support\Facades\DB;

class AutorizaciónPresupuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $autopresupuesto=Solicitud_adquisicion::where('id','1')->get();
        return view('AutorizaciónPresupuesto.AutorizaciónPresupuesto', compact('autopresupuesto'));*/
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $autopre=Solicitud_adquisicion::join('usuarios','usuarios.id','=','solicitudes_adquisiciones.de_usuario_id')
        ->join('unidades','unidades.id','=','usuarios.unidad_id')
        ->where('solicitudes_adquisiciones.id',$id)
        ->select('solicitudes_adquisiciones.*','usuarios.nombres','usuarios.apellidos','unidades.nombre_unidad',"usuarios.unidad_id")->first(); 
        if($autopre){
            $presupuesto=Presupuesto::where("unidad_id",$autopre->unidad_id)
                                      ->where("estado",true)->orderBy("created_at","desc")->first();
            $datos=json_decode($autopre->detalle_solicitud_a , true);      
            $detalles=[];                     
            foreach($datos as $columna){
               array_push($detalles,array_values($columna));
            };
        return view('AutorizaciónPresupuesto.AutorizaciónPresupuesto', compact('autopre','presupuesto','detalles'));
        }
        else{
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
    public function update(Request $request,$tipo, $id)

    {
        $solicitud=Solicitud_adquisicion::where('id',$id)->first();
       if($solicitud){
            if($tipo=='aceptar'){
            Solicitud_adquisicion::where("id", $id)->update(["estado_solicitud_a" => "Proceso de cotizacion"]); 
            $mensaje="Se Acepto la solicitud de adquisición N° ".$solicitud->codigo_solicitud_a." para la cotización";
           }elseif($tipo=='rechazar'){
            Solicitud_adquisicion::where("id", $id)->update(["estado_solicitud_a" => "Rechazado por falta de presupuesto"]); 
            $mensaje="Se Rechazo la solicitud de adquisición N° ".$solicitud->codigo_solicitud_a." por falta de presupuesto";
          
            }
            else{
                $mensaje="La solicitud de adquisición N° ".$solicitud->codigo_solicitud_a." no se pudo verificar";
            }
        return redirect()->route('lista.index')->with('confirm',$mensaje);
       }else{
           abort(404);
       }
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
