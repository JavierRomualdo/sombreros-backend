<?php

namespace App\Http\Requests\Movimiento;

use Illuminate\Foundation\Http\FormRequest;

class MovimientoUpdateRequest extends FormRequest
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
            'idTipoMovimiento'=>'required|not_in:0',
            'idProducto'=>'required',
            'idUsuario'=>'required',
            'cantidad'=>'required',
            'fecha'=>'required',
            'descripcion'=>'max:100',
        ];
    }

    public function messages()
    {
      # code...
      return [
        'idTipoMovimiento.not_in'=>'El campo Proveedor es obligatorio',
      ];
    }
}
