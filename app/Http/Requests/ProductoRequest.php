<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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
            'product.nombre_producto' => 'required_without:delete|min:3',
            'product.valor_unidad' => 'required_without:delete|integer',
            'product.categoria_id' => 'required_without:delete'
        ];
    }

    public function messages()
    {
        return [
            'product.nombre_producto.required_without' => 'Nombre del Producto es requerido.',
            'product.nombre_producto.min' => 'Nombre del Producto debe tener al menos 3 letras.',
            'product.valor_unidad.required_without' => 'Precio del Producto es requerido.',
            'product.valor_unidad.integer' => 'Precio del Producto no debe contener puntos ni comas.',
            'product.categoria_id.required_without' => 'Categoria del producto es requerida.',
            
            
            


        ];
    }
}
