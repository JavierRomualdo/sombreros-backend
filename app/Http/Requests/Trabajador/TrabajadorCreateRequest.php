<?php

namespace App\Http\Requests\Trabajador;

use Illuminate\Foundation\Http\FormRequest;

class TrabajadorCreateRequest extends FormRequest
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
            //
            'idEncargo'=>'required|not_in:0',
            'nombres'=>'required|max:50',
            'apellidos'=>'required|max:50',
            'dni'=>'required|max:8|unique:empleado,dni',
            'direccion'=>'max:100',
            'telefono'=>'required|max:9',
            'email'=>'max:50',
            'descripcion'=>'max:100',
        ];
    }

    public function messages()
    {
      # code...
      return [
        'idEncargo.not_in'=>'El campo encargo es obligatorio',
      ];
    }
}
