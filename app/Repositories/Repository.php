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
     * Find model by id/slug.
     *
     * @param $slug
     * @return Model
     */
    public function find($slug)
    {
        if (is_numeric($slug))
            return $this->getModel()->active()->whereId((int) $slug)->first();

        return $this->getModel()->active()->whereSlug($slug)->first();
    }

    /**
     * Lists the columns.
     * @example: $collection->lists('name') will return ['id' => 'name', ...] etc.
     *
     * @param $column
     * @param null $key
     * @param bool $active
     * @return array
     */
    public function lists($column, $key = null, $active = false)
    {
        $items = [];

        $collection = $active ? $this->getModel()->active()->get() : $this->getModel()->all();

        foreach ($collection as $item)
        {
            $items[$item->$key] = $item->$column;
        }

        return $items;
    }
}