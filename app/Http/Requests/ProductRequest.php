<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'=>'required|min:3|max:80',
            'industry'=>'required|min:3|max:80',
            'price'=>'required|min:1|max:10',
            'quantity'=>'required|min:1|max:10'
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => 'O nome é obrigatório',

        ];
    }
}
