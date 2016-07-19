<?php

namespace App\Http\Requests;

class SocialiteUserSaveEmailRequest extends Request
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return (bool)!$this->route()->getParameter('social')->user;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users'
        ];
    }
}