<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkerRequest extends FormRequest
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
            'worker.rut' => 'required_without:delete|min:9',
            'worker.nombres'=> 'required_without:delete',
            'worker.apellido_p' => 'required_without:delete',
            'worker.apellido_m'=> 'required_without:delete',
            'worker.cargo' => 'required_without:delete',
            'worker.direccion'=> 'required_without:delete',
            'worker.telefono' => 'required_without:delete|min:6'
        ];
    }

    public function messages(){
        return [
            'worker.rut.required_without' => 'Un R.U.T. es requerido',
            'worker.rut.min' => 'Un R.U.T. con al menos 9 dígitos es requerido',
            'worker.nombres.required_without'=> 'El campo Nombres es requerido',
            'worker.apellido_p.required_without' => 'El Apellido Paterno es requerido',
            'worker.apellido_m.required_without'=> 'El Apellido Materno es requerido',
            'worker.cargo.required_without' => 'El Cargo es requerido',
            'worker.direccion.required_without'=> 'Dirección es requerida',
            'worker.telefono.required_without' => 'Un télefono de contacto es requerido',
            'worker.telefono.min' => 'El número de télefono debe tener al menos 6 números'
        ];
    }
}
