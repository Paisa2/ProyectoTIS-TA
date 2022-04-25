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
        $empresa = Empresa::find($id);
        $razon = RespuestaCotizacion::select('razon_social')->distinct()->get();
        $rubro = Empresa::select('rubro_empresa')->distinct()->get();
        return view('Empresas.Editar', compact('empresa', 'razon', 'rubro'));
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
         'Empresa.required' => 'El campo Empresa es requerido',
         'Empresa.unique' => 'La Empresa ya ha sido registrado',
         'Nombre_Comercial.required' => 'El campo Nombre Comercial es requerido',
         'Nit.required' => 'El campo NIT es requerido',
         'Rubro.required' => 'El campo Rubro es requerido',
         'Representante_Legal' => 'El campo Representante Legal es requerido',
         'Direccion' => 'El campo Dirección es requerido',
         'Correo_Electronico' => 'El campo Correo Electronico es requerido',
         'Telefono.required' => 'El campo Telefono es requerido',
         'Representante_Legal.regex' => 'El campo Representante Legal solo debe contener letras',
         'Nit.numeric' => 'El campo Nit solo debe contener números',
         'Nit.digits_between' => 'El campo Nit debe contener entre 7 y 15 dígitos',
         'Correo_Electronico.email' => 'El formato de correo es incorrecto',
         'Telefono.numeric' => 'El campo Telefono solo debe contener números',
         'Telefono.digits_between' => 'El campo Telefono debe contener entre 6 y 10 dígitos',
         'Nit.unique' => 'El NIT ya ha sido registrado'
        ];
        $this->validate($request,[
            'Empresa' => ['required','regex:/^[\pL\s\-]+$/u', 'unique:empresas,nombre_empresa,'.$id.',id'],
            'Nombre_Comercial' => 'required',
            'Representante_Legal' => ['required','regex:/^[\pL\s\-]+$/u'],
            'Direccion' => 'required',
            'Nit' => ['required','numeric','digits_between:7,15', 'unique:empresas,nit_empresa,'.$id.',id'],
            'Rubro' => 'required',
            'Telefono' => ['required','numeric','digits_between:6,10'],
            'Correo_Electronico'=>['required','email']
        ]);
        // $tipo = $request->get($id);
        // $registro = Empresa::where('empresas.id', $id)->select('empresas.*')->first();
        $empresa = Empresa::find($id);
        $empresa->nombre_empresa     =$request->Empresa;
        $empresa->acronimo_empresa    =$request->Nombre_Comercial;
        $empresa->representante_legal=$request->Representante_Legal;
        $empresa->direccion_empresa  =$request->Direccion;
        $empresa->nit_empresa        =$request->Nit;
        $empresa->rubro_empresa      =$request->Rubro;
        $empresa->telefono_empresa   =$request->Telefono;
        $empresa->email_empresa      =$request->Correo_Electronico;
        $empresa->save();
        return redirect('ListaEmpresas')->with('confirm', 'La empresa ha sido actualizada');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registro = Empresa::find($id);
        $registro -> delete();
        return redirect('ListaEmpresas')->with('eliminado', 'Se elimino la empresa'. $registro->nombre_empresa .'correctamente');
    }
}
