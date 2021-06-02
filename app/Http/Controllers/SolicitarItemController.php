<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudItem;
use App\Models\Usuario;
use App\Models\InfoUsuario;

class SolicitarItemController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('crear.solicitud.item')->only('create');
        $this->middleware('crear.solicitud.item')->only('store');
        $this->middleware('visualizar.solicitud.item')->only('index');
        $this->middleware('visualizar.solicitud.item')->only('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudes= SolicitudItem::join('usuarios as de_usuario', 'solicitud_item.de_usuario_id', '=', 'de_usuario.id')
        ->join('usuarios as para_usuario', 'solicitud_item.para_usuario_id', '=', 'para_usuario.id')
        ->select('solicitud_item.*', 'de_usuario.nombres as nombres_de', 'para_usuario.nombres as nombres_para')
        ->get();
        return view('solicitudes-items.visualizarSolicitudesItems', compact('solicitudes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $destinatarios = InfoUsuario::join('rol_tiene_permisos', 'rol_tiene_permisos.rol_id', '=', 'info_usuario.rol_id')
        ->join('permisos', 'permisos.id', '=', 'rol_tiene_permisos.permiso_id')
        ->where('permisos.nombre_clave', 'Crear ítem de gasto')
        ->where(function ($query) {
            $query->where('info_usuario.unidad_id', session('administrativa_id'))
                ->orWhere('info_usuario.unidad_id', 1);
        })
        ->where(function ($query) {
            $query->where('info_usuario.tipo_unidad', 'unidad administrativa')
                ->orWhere('info_usuario.tipo_unidad', 'Institución');
        })
        ->select('info_usuario.id', 'info_usuario.nombres', 'info_usuario.apellidos', 'info_usuario.nombre_unidad', 'info_usuario.nombre_rol')
        ->get();
        return view('solicitudes-items.crearSolicitudItem', compact('destinatarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mensajes = [
            'para_usuario_id.required'=>'Debe seleccionar el destinatario',
            'detalle_solicitud_item.required'=>'El campo solicitud es requerido',
            'min'   => 'La solicitud debe tener por lo menos :min caracteres.',
            'max'   => 'La solicitud no puede tener más de :max caracteres.',
        ];
        $this->validate($request, [
            'para_usuario_id'=>'required',
            'detalle_solicitud_item'=>['required', 'min:5', 'max:2000'],
        ], $mensajes);
        $solicitud = new SolicitudItem($request->all());
        $solicitud->de_usuario_id = session('id');
        $solicitud->save();
        return redirect()->route('solicitudes-de-items.index')->with('confirm', 'Se envio la solicitud correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solicitud = SolicitudItem::join('usuarios', 'usuarios.id', '=', 'solicitud_item.de_usuario_id')
        ->join('usuarios as dest', 'dest.id', '=', 'solicitud_item.para_usuario_id')
        ->where('solicitud_item.id', $id)
        ->select('solicitud_item.*', 'usuarios.nombres', 'usuarios.apellidos', 'dest.nombres as nombres_dest', 'dest.apellidos as apellidos_dest')
        ->first();
        if ($solicitud) {
            return view('solicitudes-items/mostrarSolicitudItems', compact('solicitud'));
        } else {
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
