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
            'fname' => 'required|min:3|max:20',
            'lname' => 'required|min:3|max:20',
            'email' => 'required|unique:users,email,' . \Auth::id() . ',id',
        ];
    }
}