<?php

namespace App\Http\Requests\Talla;

use Illuminate\Foundation\Http\FormRequest;

class TallaCreateRequest extends FormRequest
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
            'talla'=>'required|max:50|unique:tallas,talla',
            'codigo'=>'required|min:1|max:3|unique:tallas,codigo',
            'descripcion'=>'max:100',
        ];
    }
}
