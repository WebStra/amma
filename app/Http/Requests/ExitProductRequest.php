<?php

namespace App\Http\Requests;

use App\Repositories\InvolvedRepository;

class ExitProductRequest extends Request
{
    /**
     * @return bool
     */
    public function authorize()
    {
        $involve = $this->route()->getParameter('involved');

        if ($involve
            && $this->getInvolvedRepository()->checkIfAuthInvolved($involve->product)
        )
            if ($involve->active !== 0) {
                return true;
            }

        return false;
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