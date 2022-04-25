<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //$this->user()->isAdmin()
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Empresa' => ['required','regex:/^[\pL\s\-]+$/u', 'unique:empresas,nombre_empresa'],
            'Nombre_Comercial' => ['required', 'unique:empresas,acronimo_empresa'],
            'Representante_Legal' => ['required','regex:/^[\pL\s\-]+$/u'],
            'Direccion' => 'required',
            'Nit' => ['required','numeric','digits_between:7,15', 'unique:empresas,nit_empresa'],
            'Rubro' => 'required',
            'Telefono' => ['required','numeric','digits_between:6,10'],
            'Correo_Electronico'=>['required','email']
            //
        ];
    }
    
    public function messages()
    {
         return [
         'Empresa.required' => 'El campo Empresa es requerido',
         'Empresa.unique' => 'La Empresa ya ha sido registrada.',
         'Nombre_Comercial.required' => 'El campo Nombre Comercial es requerido.',
         'Nombre_Comercial.unique' => 'El Nombre Comercial ya ha sido registrado.',
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
    }
}
