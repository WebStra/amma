<?php

namespace App\Http\Requests;


class SubscribeRequest extends Request
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
            'email' => 'required|email',

        ];
    }

}