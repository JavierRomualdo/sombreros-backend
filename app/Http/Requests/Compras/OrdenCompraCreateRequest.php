<?php

namespace App\Http\Requests\Compras;

use Illuminate\Foundation\Http\FormRequest;

class OrdenCompraCreateRequest extends FormRequest
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
            'codigo'=>'required|max:13',
            'idProveedor'=>'required|not_in:0',
            'precio_unitario'=>'required',
        ];
    }

    public function messages()
    {
      # code...
      return [
        'idProveedor.not_in'=>'El campo proveedor es obligatorio.',
      ];
    }
}
