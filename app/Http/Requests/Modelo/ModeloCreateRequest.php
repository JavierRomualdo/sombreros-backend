<?php

namespace App\Http\Requests\Modelo;

use Illuminate\Foundation\Http\FormRequest;

class ModeloCreateRequest extends FormRequest
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
            'modelo'=>'required|max:50|unique:modelos,modelo',
            'codigo'=>'required|min:3|max:3|unique:modelos,codigo',
            'photo'=>'max:50',
            'descripcion'=>'max:100',
        ];
    }
}
