<?php

namespace App\Libraries\Presenterable\Presenters;

use App\Traits\HasImagesPresentable;

class CategoryPresenter extends Presenter
{
    use HasImagesPresentable;

    /**
     * Render tax.
     *
     * @return string
     */
    public function getTax()
    {
        $tax = $this->model->tax;
        if($tax <= 0)
            $tax = 0;

        return sprintf('%s%%', $tax);
    }

    /**
     * Render name.
     * 
     * @param bool $upper
     * @return mixed|string
     */
    public function renderName($upper = false)
    {
        $name = $this->model->name;

        if($upper)
            return strtoupper($name);

        return $name;
    }

    /**
     * Render name with tax.
     * 
     * @return string
     */
    public function renderNameWithTax()
    {
        return sprintf('%s, taxa (%s)', $this->renderName(), $this->getTax());
    }
}