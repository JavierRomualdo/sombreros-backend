<?php

namespace App\Http\Requests\Tejido;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class TejidoUpdateRequest extends FormRequest
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
      //$tabla = Tejidos::find($this->tejidos);
      $id = isset($this->tejidos) ? $this->post->id : null;
      //$id = $this->tejidos->id;
        return [
            //$this->route->getparameter('tejidos')
            'tejido'=>'required|max:50|unique:tejidos,tejido,'.$id,
            'photo'=>'max:50',
            'descripcion'=>'max:100',
        ];
    }
}
