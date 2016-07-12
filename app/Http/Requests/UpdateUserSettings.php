<?php

namespace App\Http\Requests;


class UpdateUserSettings extends Request
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
            /*'photo' => 'mimes:jpeg,png',*/
            'fname' => 'min:5|max:20',
            'lname' => 'min:5|max:20',
            'email' => 'unique:users,email,'.\Auth::id().',id',
            'password' => 'required|min:6|confirmed', 

        ];
    }
}