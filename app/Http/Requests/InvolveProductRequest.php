<?php

namespace App\Http\Requests;

use App\Repositories\InvolvedRepository;
use Illuminate\Support\Facades\Auth;

class InvolveProductRequest extends Request
{
    /**
     * @return bool
     */
    public function authorize()
    {
        $product = $this->route()->getParameter('product');
       /* if ($product) {
            if (! $this->getInvolvedRepository()->checkIfAuthInvolved($product))
                return true;
        }*/

        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'count' => $this->getInvolvedRepository()->countRules()
        ];
    }

    /**
     * @return InvolvedRepository
     */
    private function getInvolvedRepository()
    {
        return (new InvolvedRepository());
    }
}