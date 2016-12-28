<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class ResendConfirmationRequest extends Request
{
    /**
     * If user can perform this request
     */
    public function authorize()
    {
        if(! Auth::user()->confirmed)
            return true;
        
        return false;
    }
    
    /**
     * @return array
     */
    public function rules()
    {
        return [];
    }
}