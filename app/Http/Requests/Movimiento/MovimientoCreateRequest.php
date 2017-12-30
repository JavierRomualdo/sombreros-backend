<?php

namespace App\Http\Requests\Movimiento;

use Illuminate\Foundation\Http\FormRequest;

class MovimientoCreateRequest extends FormRequest
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
            'codigo'=>'required|max:13',
            //'idModelo'=>'required|not_in:0',
            //idTejido'=>'required|not_in:0',
            //'idMaterial'=>'required|not_in:0',
            //'idPublicoDirigido'=>'required|not_in:0',
            //'idTalla'=>'required|not_in:0',
            //'idProveedor'=>'required|not_in:0',
            //'idProducto'=>'required|max:13|min:13',
            'cantidad'=>'required',
            'stock_actual'=>'required',
            'precio'=>'required',
            'precio_total'=>'required',
            'fecha'=>'required',
            'descripcion'=>'max:100',
        ];
    }

    public function messages()
    {
      # code...
      return [
        /*'idTipoMovimiento.not_in'=>'El campo movimiento es obligatorio.',
        'idModelo.not_in'=>'El campo modelo es obligatorio.',
        'idTejido.not_in'=>'El campo modelo es obligatorio.',
        'idMaterial.not_in'=>'El campo modelo es obligatorio.',
        'idPublicoDirigido.not_in'=>'El campo modelo es obligatorio.',
        'idTalla.not_in'=>'El campo modelo es obligatorio.',
        'idProveedor.not_in'=>'El campo modelo es obligatorio.',*/

        /*'idTipoMovimiento.required'=>'El campo movimiento es obligatorio.',
        'idModelo.required'=>'El campo modelo es obligatorio.',
        'idTejido.required'=>'El campo tejido es obligatorio.',
        'idMaterial.required'=>'El campo material es obligatorio.',
        'idPublicoDirigido.required'=>'El campo publico es obligatorio.',
        'idTalla.required'=>'El campo talla es obligatorio.',
        'idProveedor.required'=>'El campo proveedor es obligatorio.',*/
      ];
    }
}
