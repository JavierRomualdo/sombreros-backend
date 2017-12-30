<?php

namespace App\Http\Requests\Sombreros;

use Illuminate\Foundation\Http\FormRequest;

class SombreroCreateRequest extends FormRequest
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
            'idModelo'=>'required|not_in:0',
            'idTejido'=>'required|not_in:0',
            'idPublicoDirigido'=>'required|not_in:0',
            'idMaterial'=>'required|not_in:0',
            'idTalla'=>'required|not_in:0',
            'codigo'=>'required|min:13|max:13|unique:sombrero,codigo',
            'stock_minimo'=>'required',
            'stock_maximo'=>'required',
        ];
    }

    public function messages()
    {
      # code...
      return [
        'idProveedor.not_in'=>'El campo Proveedor es obligatorio',
        'idModelo.not_in'=>'El campo Modelo es obligatorio',
        'idTejido.not_in'=>'El campo Tejido es obligatorio',
        'idPublicoDirigido.not_in'=>'El campo Publico Dirigido es obligatorio',
        'idMaterial.not_in'=>'El campo Material es obligatorio',
        'idTalla.not_in'=>'El campo Talla es obligatorio',
      ];
    }
}
