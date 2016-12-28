<?php

namespace App\Http\Requests;

use Auth;

class UpdateUserPassword extends Request
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * @return array
     */
    public function rules()
    {
        \Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {
            return \Hash::check($value, current($parameters));
        });

        return [
            'old_password' => 'required|old_password:' . Auth::user()->password,
            'password' => 'required|min:6|confirmed',
        ];
    }
}