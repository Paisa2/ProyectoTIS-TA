<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdquisicionRequest;
use App\Models\Solicitud_adquisicion;
use App\Models\Solicitud_cotizacion;
use App\Models\ItemGasto;
use App\Models\ProcesoCotizacionId;
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
        $unidadId = session('unidad_id');
        if(session('tipo_unidad') == 'unidad de gasto'){
            $columnaUnidad = 'de_unidad_id';
            $estadoSolicitud = '';
        }else if(session('tipo_unidad') == 'unidad administrativa'){
            $columnaUnidad = 'para_unidad_id';
            $estadoSolicitud = 'Registrado';
        }else{
            $columnaUnidad = '1';
            $unidadId = '1';
            $estadoSolicitud = '';
        }
        $solicitudes=Solicitud_adquisicion::where('tipo_solicitud_a', 'like', "%$tipo2%")
        ->where('tipo_solicitud_a', 'like', "%$tipo3%")
        ->whereRaw($columnaUnidad . '=' . $unidadId)
        ->where('estado_solicitud_a', '!=', $estadoSolicitud)
        ->orderBy('updated_at','desc')->paginate(10);
        foreach($solicitudes as $solicitud){
            $solicitud->cotizacion=Solicitud_cotizacion::where('solicitud_a_id',$solicitud->id)->count();
            $solicitud->informes=ProcesoCotizacionId::where('solicitud_a_id',$solicitud->id)->count();
            if($solicitud->cotizacion > 0){
                $solicitud->cotizacion_id=Solicitud_cotizacion::where('solicitud_a_id',$solicitud->id)->first()->id;
            }
            if($solicitud->informes > 0){
                $solicitud->informe_id=ProcesoCotizacionId::where('solicitud_a_id',$solicitud->id)->first()->informe_autorizacion_id;
            }
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
        $solicitudes->de_unidad_id = session('unidad_id');
        $solicitudes->para_unidad_id = session('administrativa_id');
        $solicitudes->save();
        return redirect('lista')->with('confirm', 'Solicitud de adquisición Registrada');
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
        $edicion = Solicitud_adquisicion::where('id', $id)->first();
        $adquisicion=ItemGasto::where('tipo_item', 'Especifico')->get();
        if($edicion){
            $datos=json_decode($edicion->detalle_solicitud_a , true);      
            $detalles=[];                     
            foreach($datos as $columna){
                array_push($detalles,array_values($columna));
            }
        } else {
            abort(404);
        }
        return view('solicitudes-adq.editarSolicitudA', compact('adquisicion', 'edicion', 'detalles'));
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
        $mensajes = [
            'justificacion.min' => 'La justificación debe tener por lo menos 20 caracteres'
        ];
        $this->validate($request, [
            'fecha' => 'required',
            'justificacion' => ['required','min:20'],
            'total' => 'required'
            ], $mensajes);
        $solicitud = Solicitud_adquisicion::where('id', $id)->first();
        if($solicitud){
            $solicitud->estado_solicitud_a = 'Registrado';
            $solicitud->justificacion_solicitud_a = $request->justificacion;
            $solicitud->detalle_solicitud_a = json_encode($request->detalle);
            $solicitud->fecha_entrega = $request->fecha;
            $solicitud->total_solicitud_a = $request->total;
            $solicitud->save();
        } else {
            abort(404);
        }
        
        return redirect('lista')->with('confirm', 'Solicitud de adquisición Editada');
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

    function reenviarAdq($id){
        $adquisicion = Solicitud_adquisicion::where('id', $id)->first();
        $adquisicion->estado_solicitud_a = 'Pendiente';
        $adquisicion->save();
        return redirect()->route('lista.index');
    }
}
