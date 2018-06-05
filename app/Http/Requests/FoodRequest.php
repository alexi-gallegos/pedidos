<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends FormRequest
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
            'category.descripcion' => 'required_without:delete|min:3'
        ];
    }

    public function messages(){
        return [
            'category.descripcion.required_without' => 'Un Nombre o descripción de Alimento es necesario.',
            'category.descripcion.min' => 'Un Nombre de al menos 3 letras es requerido.'
        ];
    }
}
