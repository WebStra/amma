<?php

namespace App\Libraries\Presenterable;

use App\Libraries\Presenterable\Presenters\Presenter;

trait Presenterable
{
    /**
     * Serialize presenter.
     * 
     * @return Presenter
     */
    public function scopePresent()
    {
        $presenter = $this->presenter;
        
        return new $presenter($this);
    }
}