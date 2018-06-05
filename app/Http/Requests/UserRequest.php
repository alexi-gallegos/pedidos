<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'user.email' => 'required_without:delete',
            'user.password' => 'required_without:delete|min:6'
        ];
    }

    public function messages(){
        return[
            'user.nombre.required_without' => 'Un Nombre o Nickname es requerido.',
            'user.nombre.min' => 'Un Nombre o Nickname de al menos 3 letras es necesario.',
            'user.email.required_without' => 'Un E-mail válido es requerido.',
            'user.password.required_without' => 'Una contraseña es requerida.',
            'user.password.min' => 'Una contraseña de al menos 6 caracteres es requerida.'
        ];
    }
}
