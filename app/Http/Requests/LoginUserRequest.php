<?php

namespace App\Http\Requests;

use App\Http\Controllers\Auth\AuthController;

class LoginUserRequest extends Request
{
    /**
     * Login by username.
     *
     * @var string
     */
    protected $username;

    /**
     * LoginUserRequest constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->username = (new AuthController)->loginUsername();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            $this->username => 'required',
            'password' => 'required'
        ];
    }
}