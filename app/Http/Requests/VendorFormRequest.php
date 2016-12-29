<?php

namespace App\Http\Requests;

class VendorFormRequest extends Request
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
            'name' => 'required|unique:vendors|min:2|max:250',
            'email' => 'email',
            'phone' => 'required|digits:8',
            'description' => 'min:10|max:250'
        ];
    }
}