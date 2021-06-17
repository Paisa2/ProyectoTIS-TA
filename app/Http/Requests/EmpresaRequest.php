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
            'Empresa' => ['required','regex:/^[\pL\s\-]+$/u'],
            'Nombre_Comercial' => 'required',
            'Representante_Legal' => ['required','regex:/^[\pL\s\-]+$/u'],
            'Direccion' => 'required',
            'Nit' => ['required','numeric'],
            'Rubro' => 'required',
            'Telefono' => ['required','numeric'],
            'Correo_Electronico'=>['required','email']
            //
        ];
    }
    
    public function messages()
    {
         return [
         'Empresa.required' => 'El campo Empresa es requerido',
         'Representante_Legal.regex' => 'El campo Representante Legal solo debe contener letras',
         'Nit.numeric' => 'El campo Nit solo debe contener números',
        //  'Nit.digits_between' => 'El campo Nit debe contener entre 6 y 12 dígitos',
         'Correo_Electronico.email' => 'El formato de correo es incorrecto',
         'Telefono.numeric' => 'El campo Telefono solo debe contener números'
         ];
    }
}
