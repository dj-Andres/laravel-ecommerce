<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string|unique:products|max:150',
            //'image' => 'required|dimensions:min_width=100,min_height=200',
            //'slug' => 'required|string',
            'code' => 'nullable|string',
            'sell_price' => 'required',
            'short_description'=> 'nullable|string|max:100',
            'long_description'=> 'nullable|string|max:250',
            'subcategory_id'=>'integer|required|exists:App\Models\SubCategory,id',
            'provider_id'=>'integer|required|exists:App\Models\Provider,id',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Este campo es requerido.',
            'name.string' => 'El valor no es correcto.',
            'name.unique' => 'El producto ya se encuentra registrado',
            'name.max' => 'Solo se permite un maximo de 150 caracteres.',

            'image.required' => 'Este campo es requerido.',
            //'image.dimensions'=> 'Solo se permiten imagenes en 100x200 px.',

            'sell_price.required' => 'Este campo es requerido.',

            'category_id.integer' => 'El valor no es correcto.',
            'category_id.required' => 'Este campo es requerido',
            'category_id.exists' => 'La Categoria no existe.',

            'provider_id.integer' => 'El valor no es correcto.',
            'provider_id.required' => 'Este campo es requerido',
            'provider_id.exists' => 'El Proveedor no existe.',
        ];
    }
}
