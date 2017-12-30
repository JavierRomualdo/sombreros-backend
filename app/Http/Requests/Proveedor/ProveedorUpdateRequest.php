<?php

namespace App\Http\Requests\Proveedor;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorUpdateRequest extends FormRequest
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
            //|unique:materiales,material,'.$this->route->getparameter('material'),
            'nombres'=>'required|max:50',
            'apellidos'=>'required|max:50',
            'dni'=>'required|max:8|unique:proveedor,dni,'.$this->get('id'),
            'empresa'=>'required|max:70|unique:proveedor,empresa,'.$this->get('id'),
            'ruc'=>'required|min:11|max:11|unique:proveedor,ruc,'.$this->get('id'),
            'direccion'=>'required|max:80',
            'telefono'=>'max:15',
            'correo'=>'max:50',
            'fecha_ingreso'=>'required',
        ];
    }
}
