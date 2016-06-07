<?php

namespace App\Repositories;

use App\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements RepositoryContract
{
    /**
     * Ascendent.
     */
    const ASC = 'asc';

    /**
     * Descendent.
     */
    const DESC = 'desc';

    /**
     * Get model by id.
     * 
     * @param $id
     * @return Model
     */
    public function getById($id)
    {
        return self::getModel()
            ->whereId($id)
            ->first();
    }
}