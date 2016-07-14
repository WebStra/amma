<?php

namespace App\Http\Requests;


class UpdateUserPassword extends Request
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            // todo: add validator's rules.
            'password' => 'required|min:6|confirmed', 
        ];
    }
}