<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
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
            'position.cargo' => 'required_without:delete|min:3',
            'position.descripcion'=> 'required_without:delete|min:20'
        ];
    }

    public function messages(){
        return [
            'position.cargo.required_without' => 'Un Cargo es requerido',
            'position.cargo.min' => 'Un Cargo con al menos 4 letras es requerido',
            'position.descripcion.required_without' => 'Una breve descripción es requerida',
            'position.descripcion.min' => 'Una breve descripción de al menos 20 letras es requerida'
        ];
    }
}
