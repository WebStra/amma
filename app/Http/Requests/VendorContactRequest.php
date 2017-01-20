<?php
namespace App\Http\Requests;

use Response;
/**
 * Class VendorContactRequest
 * @package App\Http\Requests
 */
class VendorContactRequest extends Request
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
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email'
        ];
    }

}