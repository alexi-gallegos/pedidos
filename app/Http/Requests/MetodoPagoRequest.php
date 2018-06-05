<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MetodoPagoRequest extends FormRequest
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
            'payment.metodo_pago' => 'required_without:delete|min:2'
        ];
    }

    public function messages(){
        return [
            'payment.metodo_pago.required_without' => 'Un Método de Pago es requerido.',
            'payment.metodo_pago.min' => 'Un Método de Pago con al menos 2 letras es necesario.'
        ];
    }
}
