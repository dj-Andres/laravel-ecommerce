<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $rules = [
            //'name' => 'required|string|unique:categories'.$this->route('category')->id.'|max:50',
            'description' => 'nullable|string|max:250',
        ];
        return $rules;
    }

    public function messajes()
    {
        $messajes = [
            'name.required' => 'Este campo es requerido.',
            'name.string' => 'El valor no es correcto.',
            'name.max' => 'Solo se permite un maximo de 50 caracteres.',
            'description.string' => 'El valor no es correcto.',
            'description.max' => 'Solo se permite un maximo de 250 caracteres.'
        ];
        return $messajes;
    }
}
