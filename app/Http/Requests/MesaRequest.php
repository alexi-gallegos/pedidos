<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MesaRequest extends FormRequest
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
            'table.numero_mesa' => 'required_without:delete|integer|min:0'
        ];
    }

    public function messages(){
        return [
            'table.numero_mesa.required_without' => 'El número de la mesa es necesario.',
            'table.numero_mesa.integer' => 'El número de la mesa debe ser un número.',
            'table.numero_mesa.min' => 'El número de la mesa debe ser mayor a 0.'
        ];
    }
}
