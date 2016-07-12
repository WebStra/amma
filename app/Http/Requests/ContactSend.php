<?php

namespace App\Http\Requests;


class ContactSend extends Request
{
    
 /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */


    public function rules()
    {

        
        return [
            // todo: add validator's rules.
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'phone' => 'required|digits:8',
            'message' => 'required', 

        ];
    }

}