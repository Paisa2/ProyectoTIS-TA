<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicituditem;
use App\Models\Usuario;

class SolicitarItemController extends Controller
{
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
        return view("solicitudes-items.visualizarSolicitudesItems", compact('solicitudes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session(['id' => '5']);
        session(['unidad_id' => '4']);
        session(['unidad_unidad_id' => '2']);
        $destinatarios = Usuario::join('usuario_tiene_roles', function ($join) {
            $join->on('usuario_tiene_roles.usuario_id', '=', 'usuarios.id')
                 ->where('estado', 1);
        })
        ->join('roles', 'roles.id', '=', 'usuario_tiene_roles.rol_id')
        ->join('rol_tiene_permisos', 'rol_tiene_permisos.rol_id', '=', 'roles.id')
        ->join('permisos', function ($join) {
            $join->on('permisos.id', '=', 'rol_tiene_permisos.permiso_id')
                 ->where('nombre_clave', 'Crear ítems de gasto');
        })
        ->join('unidades', 'unidades.id', '=', 'usuarios.unidad_id')
        ->where(function ($query) {
            $query->where('unidades.unidad_id', session('unidad_unidad_id'))
                  ->orWhere('unidades.unidad_id', 1);
        })
        ->where(function ($query) {
            $query->where('unidades.tipo_unidad', 'unidad administrativa')
                  ->orWhere('unidades.tipo_unidad', 'Institución');
        })
        ->select('usuarios.id', 'usuarios.nombres', 'unidades.nombre_unidad', 'roles.nombre_rol')
        ->get();
        return view("solicitudes-items.crearSolicitudItem", compact('destinatarios'));
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
        $solicitud->de_usuario_id = session("id");
        $solicitud->save();
        return redirect()->route("solicitudes-de-items.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
