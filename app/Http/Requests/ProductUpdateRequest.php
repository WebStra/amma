<?php

namespace App\Http\Requests;


class ProductUpdateRequest extends Request
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
            //
        ];
    }
}