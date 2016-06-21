<?php

namespace App\Libraries\Metaable;

use App\Repositories\Repository as BaseRepository;

class Repository extends BaseRepository
{
    /**
     * @return Meta
     */
    public function getModel()
    {
        return new Meta();
    }

    /**
     * Create meta.
     * 
     * @param $metaable
     * @param $key
     * @param $value
     * @param $group
     * @return Meta
     */
    public function create($metaable, $key, $value, $group)
    {
        return $this->getModel()
            ->create([
                'metaable_id' => $metaable->id,
                'metaable_type' => get_class($metaable),
                'key' => $key,
                'value' => $value,
                'group' => (! is_null($group)) ? $group : 'other'
            ]);
    }
}