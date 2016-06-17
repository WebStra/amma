<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Auth\Guard;

class VendorUpdateFormRequest extends Request
{
    /**
     * @var Guard
     */
    private $auth;

    /**
     * VendorUpdateFormRequest constructor.
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        parent::__construct();

        $this->auth = $auth;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->route('vendor')->user_id == $this->auth->id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:250|unique:vendors,name,' . $this->route('vendor')->id,
            'email' => 'email',
            'phone' => 'numeric',
            'description' => 'min:10|max:250'
        ];
    }
}