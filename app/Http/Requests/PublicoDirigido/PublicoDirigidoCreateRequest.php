<?php

namespace App\Http\Requests\PublicoDirigido;

use Illuminate\Foundation\Http\FormRequest;

class PublicoDirigidoCreateRequest extends FormRequest
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
            'publico'=>'required|max:50|unique:publicodirigido,publico',
            'codigo'=>'required|min:3|max:3|unique:publicodirigido,codigo',
            'descripcion'=>'max:100',
        ];
    }
}
