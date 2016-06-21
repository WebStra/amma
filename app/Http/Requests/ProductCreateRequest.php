<?php

namespace App\Http\Requests;

use Illuminate\Session\Store;

class ProductCreateRequest extends Request
{
    /**
     * @var Store
     */
    protected $session;

    /**
     * ProductCreateRequest constructor.
     * @param Store $session
     */
    public function __construct(Store $session)
    {
        parent::__construct();

        $this->session = $session;
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        return $this->route('product')->id == $this->session->get('drafted_product');
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'min:5'
        ];
    }
}