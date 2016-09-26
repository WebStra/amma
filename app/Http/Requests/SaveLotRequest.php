<?php

namespace App\Http\Requests;

class SaveLotRequest extends Request
{
    /**
     * If user can perfrom current request
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Form request validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}