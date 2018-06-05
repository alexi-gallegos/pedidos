<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'user.nombre' => 'required_without:delete|min:3',
            'user.email' => 'required_without:delete'
        ];
    }

    public function messages(){
        return[
            'user.nombre.required_without' => 'Un Nombre o Nickname es requerido.',
            'user.nombre.min' => 'Un Nombre o Nickname de al menos 3 letras es necesario.',
            'user.email.required_without' => 'Un E-mail válido es requerido.'
        ];
    }
}
