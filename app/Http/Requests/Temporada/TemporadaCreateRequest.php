<?php

namespace App\Http\Requests\Temporada;

use Illuminate\Foundation\Http\FormRequest;

class TemporadaCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return [
            //
            'temporada'=>'required|max:50|unique:temporada,temporada',
            'photo'=>'max:50',
            'fecha_inicio'=>'required',
            'fecha_fin'=>'required',
            'descripcion'=>'max:100',
        ];
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
        ];
    }
}
