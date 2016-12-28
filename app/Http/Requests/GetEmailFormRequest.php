<?php

namespace App\Http\Requests;

class GetEmailFormRequest extends Request
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
            //
        ];
    }
}