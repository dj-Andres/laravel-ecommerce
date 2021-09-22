<?php

namespace App\Http\Requests\Provider;

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

    public function rules()
    {
        $rules =  [
            'name' => 'required|string|max:250',
            'email' => 'required|email|string|unique:providers,email,' .$this->route('provider')->id .'|max:250',
            'ruc_number' => 'required|string|unique:providers,ruc_number'.$this->route('provider')->id .'|max:11|min:11',
            'address' => 'nullable|string|max:250',
            'phone' => 'required|string|unique:providers,phone'.$this->route('provider')->id .'|max:10|min:10',
        ];
        return $rules;
    }

    public function messajes()
    {
        $messajes =  [
            'name.required' => 'Este campo es requerido.',
            'name.string' => 'El valor no es correcto.',
            'name.max' => 'Solo se permite un maximo de 250 caracteres.',

            'email.required' => 'Este campo es requerido.',
            'email.email' => 'El formato debe ser de un email valido.',
            'email.string' => 'El valor no es correcto.',
            'email.max' => 'Solo se permite 200 caracteres.',
            'email.uniqued' => 'El correo electronico ya se encuentra registrado!',

            'ruc_number.required' => 'Este campo es requerido.',
            'ruc_number.string' => 'El valor no es correcto.',
            'ruc_number.max' => 'Solo se permite 11 caracteres.',
            'ruc_number.min' => 'Minimo de valores  debe ser 11 caracteres..',
            'ruc_number.uniqued' => 'El numero de ruc ya se encuentra registrado!',

            'address.string' => 'El valor no es correcto.',
            'address.max' => 'Solo se permite un maximo de 250 caracteres.',

            'phone.required' => 'Este campo es requerido.',
            'phone.string' => 'El valor no es correcto.',
            'phone.max' => 'Solo se permite 10 numeros.',
            'phone.min' => 'Minimo de numeros  debe ser 10.',
            'phone.uniqued' => 'El numero ya se encuentra registrado!',
        ];

        return $messajes;
    }
}
