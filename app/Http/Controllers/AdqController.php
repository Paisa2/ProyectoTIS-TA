<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdquisicionRequest;
use App\Models\Solicitud_adquisicion;
use App\Models\Solicitud_cotizacion;
use App\Models\ItemGasto;
use Illuminate\Http\Request;

class AdqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct(){
    //     $this->middleware('SolicitaAdq',['only'=>['index']]);
    // }
    public function index(Request $request)
    {
        $tipo1 = $request->get('todos');
        $tipo2 = $request->get('compra');
        $tipo3 = $request->get('alquiler');
        // $todos=Solicitud_adquisicion::all();
        $solicitudes=Solicitud_adquisicion::where('tipo_solicitud_a', 'like', "%$tipo2%")->where('tipo_solicitud_a', 'like', "%$tipo3%")->orderBy('updated_at','desc')->get();
        foreach($solicitudes as $solicitud){
            $solicitud->cotizacion=Solicitud_cotizacion::where('solicitud_a_id',$solicitud->id)->count();
        }
        return view('solicitudes-adq.lista', compact('solicitudes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $adquisicion=ItemGasto::where('tipo_item', '=', 'Especifico')->get();
        return view('solicitudes-adq.solicitud', compact('adquisicion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdquisicionRequest $request)
    {
        $traendodatos=Solicitud_adquisicion::max("id");

        $solicitudes = new Solicitud_adquisicion;
        $solicitudes->tipo_solicitud_a = $request->tipo;
        $solicitudes->estado_solicitud_a = 'Registrado';
        $solicitudes->justificacion_solicitud_a = $request->justificacion;
        $solicitudes->detalle_solicitud_a = json_encode($request->detalle);
        $solicitudes->fecha_entrega = $request->fecha;
        $solicitudes->codigo_solicitud_a = 100000+$traendodatos;
        $solicitudes->total_solicitud_a = $request->total;
        $solicitudes->de_usuario_id = session('id');
        $solicitudes->para_unidad_id = session('administrativa_id');
        $solicitudes->save();
        return redirect('lista')->with('confirm', 'Solicitud de adquisición Enviada');
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
            $datos=json_decode($autopre->detalle_solicitud_a , true);      
            $detalles=[];                     
            foreach($datos as $columna){
              array_push($detalles,array_values($columna));
            };
        return view('solicitudes-adq.detalleSolicitudA', compact('autopre','detalles'));
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
