<?php

namespace App\Http\Requests\ProveedorPrecio;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorPrecioCreateRequest extends FormRequest
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
            'idProveedor'=>'required|not_in:0',
            'codigo'=>'required|max:13',
            'precio_compra'=>'required',
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
