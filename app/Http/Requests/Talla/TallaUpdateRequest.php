<?php

namespace App\Http\Requests\Talla;

use Illuminate\Foundation\Http\FormRequest;

class TallaUpdateRequest extends FormRequest
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
            'talla'=>'required|max:50|unique:tallas,talla,id,'.$this->get('id'),
            'descripcion'=>'max:100',
        ];
    }
}
