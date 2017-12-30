<?php

namespace App\Http\Requests\Proveedor;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorCreateRequest extends FormRequest
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
            /*'nombres'=>'required|max:50',
            'apellidos'=>'required|max:50',
            'dni'=>'required|max:8|unique:proveedor,dni',
            'empresa'=>'required|max:70||unique:proveedor,empresa',
            'ruc'=>'required|min:11|max:11|unique:proveedor,ruc',
            'direccion'=>'required|max:80',
            'telefono'=>'required|max:15',
            'correo'=>'max:50',
            'fecha_ingreso'=>'required',*/
        ];
    }
}
