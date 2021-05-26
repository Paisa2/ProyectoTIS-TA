<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AutorizaciónPresupuestoController;
use App\Models\Solicitud_adquisicion;
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
       $autopresupuesto=Solicitud_adquisicion::join('usuarios','usuarios.id','=','solicitudes_adquisiciones.de_usuario_id')
       ->join('unidades','unidades.id','=','usuarios.unidad_id')
       ->join('presupuestos','presupuestos.unidad_id','=','unidades.id')
       ->where('solicitudes_adquisiciones.id',$id)
       ->select('solicitudes_adquisiciones.*','usuarios.nombres','usuarios.apellidos','unidades.nombre_unidad','presupuestos.monto')->get();     
       
        return view('AutorizaciónPresupuesto.AutorizaciónPresupuesto', compact('autopresupuesto'));
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
