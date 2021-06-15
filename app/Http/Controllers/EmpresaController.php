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
    public function index(Request $request)
    {
        $rubros = $request->get('rubro');
        $todos = $request;
        /*$registros = Empresa::get();*/
        if($rubros){
            $registros = Empresa::where('rubro_empresa','like','rubros')->get();
        }else{
            $registros = Empresa::get();
        }
        return view('Empresas.ListaEmpresas', compact('registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rubro = RespuestaCotizacion::get();
        return view('Empresas.NuevaEmpresa', compact('rubro'));
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
        $empresas->representante_legal=$request->Representante_Legal;
        $empresas->direccion_empresa  =$request->Direccion;
        $empresas->nit_empresa        =$request->Nit;
        $empresas->rubro_empresa      =$request->Rubro;
        $empresas->telefono_empresa   =$request->Telefono;
        $empresas->email_empresa      =$request->Correo_Electronico;
        $empresas->save();
        return redirect('ListaEmpresas')->with('confirm', 'La empresa ha sido registrada');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        return view('Empresas.DetalleEmpresa');
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
