<?php

namespace App\Http\Requests\Profile;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'first_name' => 'string|required|max:150',
            'last_name' => 'string|required|max:150',
            'cedula' => 'string|required|unique:profiles|max:10',
            'ruc' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:150',
            'phone'=> 'string|unique:profiles|max:10',
            'email' => 'string|email|unique:profiles|max:200',
        ];
        return $rules;
    }
}
