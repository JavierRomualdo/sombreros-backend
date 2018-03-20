<?php

namespace App\Http\Requests\Tejido;

use Illuminate\Foundation\Http\FormRequest;

class TejidoCreateRequest extends FormRequest
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
            'tejido'=>'required|max:50|unique:tejidos,tejido',
            'codigo'=>'required|min:3|max:3|unique:tejidos,codigo',
            'photo'=>'max:50',
            'descripcion'=>'max:100',
        ];
    }
}
