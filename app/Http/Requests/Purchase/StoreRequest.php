<?php

namespace App\Http\Requests\Purchase;

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
        return [
            'provider_id' => 'required',
            'impuesto' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'total' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
        ];
    }
}
