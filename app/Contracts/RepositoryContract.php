<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface RepositoryContract
{
    /**
     * @return Model
     */
    public function getModel();
}