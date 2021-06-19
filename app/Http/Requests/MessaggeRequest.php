<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MessaggeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tipo_unidad' => 'required',
            'nombre_unidad' => [
                'required','min:2','max:255', 'regex:/^[\pL\s\-]+$/u', 
                Rule::unique('unidades')->ignore($this->route('registro'))],
            'unidad_id' => 'required',
            'telefono_unidad' => ['required','numeric','digits_between:8,12']
            //
        ];
    }
    public function messages(){
        return[
            'nombre_unidad.required' => 'El campo Nombre es requerido',
            'nombre_unidad.min' => 'El campo Nombre debe tener mas de 2 caracteres',
            'nombre_unidad.max' => 'El campo Nombre no debe tener mas de 255 caracteres',
            'nombre_unidad.regex' => 'El campo Nombre solo permite caracteres alfabeticos',
            'nombre_unidad.unique' => 'La unidad ya ha sido registrada',
            'tipo_unidad.required' => 'El campo tipo es requerido',
            'unidad_id.required' => 'El campo Pertenece A es requerido'
        ];
    }
}
