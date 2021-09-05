<?php

namespace App\Http\Requests\Client;

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
        $rules = [
            'name' => 'string|required|max:150',
            'cedula' => 'string|required|unique:clients|max:10',
            'ruc'=> 'nullable|string|max:10',
            'address'=>'nullable|string|max:150',
            'phone'=>'string|nullable|unique:clients|max:10',
            'email'=> 'string|email|nullable|unique:clients|max:200',
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'name.required' => 'Este campo es requerido.',
            'name.string' => 'El valor no es correcto.',
            'name.max' => 'Solo se permite un maximo de 150 caracteres.',

            'cedula.required' => 'Este campo es requerido.',
            'cedula.string' => 'El valor no es correcto.',
            'cedula.unique' => 'La cedula ya se encuentra registrada.',
            'cedula.max' => 'Solo se permite un maximo de 10 caracteres.',

            'ruc.required' => 'Este campo es requerido.',
            'ruc.string' => 'El valor no es correcto.',
            'ruc.max' => 'Solo se permite un maximo de 10 caracteres.',

            'address.string' => 'El valor no es correcto.',
            'address.required' => 'Este campo es requerido.',
            'address.max' => 'Solo se permite un maximo de 250 caracteres.',

            'email.required' => 'Este campo es requerido.',
            'email.email'=> 'El formato debe ser de un email valido.',
            'email.string' => 'El valor no es correcto.',
            'email.max' => 'Solo se permite 200 caracteres.',
            'email.uniqued' => 'El correo electronico ya se encuentra registrado!',

            'phone.required' => 'Este campo es requerido.',
            'phone.string' => 'El valor no es correcto.',
            'phone.max' => 'Solo se permite 10 numeros.',
            'phone.uniqued' => 'El numero ya se encuentra registrado!',
        ];
        return $messages;
    }
}
