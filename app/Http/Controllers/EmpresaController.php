<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaRequest;
use App\Models\Empresa;
use App\Models\RespuestaCotizacion;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function rubro($id){
    //     $tipo = Empresa::where('empresas.id', $id)->select('empresas.*')->first();
    //     return view('Empresas.ListaEmpresas', compact('tipo'));
    // }
    public function index(Request $request)
    {   
        $tipo1 = $request->get('rubro');
        $registros = Empresa::select('rubro_empresa')->distinct()->get();
        $tabla = Empresa::where('rubro_empresa', 'like', "%$tipo1%")->orderBy('created_at', 'desc')->get();
        return view('Empresas.ListaEmpresas', compact('registros','tabla','tipo1'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $razon = RespuestaCotizacion::select('razon_social')->distinct()->get();
        $rubro = Empresa::select('rubro_empresa')->distinct()->get();
        return view('Empresas.NuevaEmpresa', compact('razon', 'rubro'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpresaRequest $request)
    {
        $empresas = new Empresa;
        $empresas->nombre_empresa     =$request->Empresa;
        $empresas->acronimo_empresa    =$request->Nombre_Comercial;
        $empresas->representante_legal=$request->Representante_Legal;
        $empresas->direccion_empresa  =$request->Direccion;
        $empresas->nit_empresa        =$request->Nit;
        $empresas->rubro_empresa      =$request->Rubro;
        $empresas->telefono_empresa   =$request->Telefono;
        $empresas->email_empresa      =$request->Correo_Electronico;
        $empresas->save();
        return redirect('ListaEmpresas')->with('confirm', 'La empresa se registro correctamente');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $registro = Empresa::where('empresas.id', $id)->select('empresas.*')->first();
        return view('Empresas.DetalleEmpresa', compact('registro'));
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
        $tipo = $request->get($id);
        $registro = Empresa::where('empresas.id', $id)->select('empresas.*')->first();

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
