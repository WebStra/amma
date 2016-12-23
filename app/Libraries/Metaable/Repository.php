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
    public function create($metaable, $meta, $group)
    {
        return $this->getModel()
            ->create([
                'metaable_id'   => $metaable->id,
                'metaable_type' => get_class($metaable),
                'key'           => $meta['key'],
                'value'         => $meta['value'],
                'group'         => (! is_null($group)) ? $group : 'other',
                'key_unique'    => $meta['key_unique']
            ]);
    }

    /**
     * Deletes group
     *
     * @param $group
     * @return mixed
     */
    public function removeGroup($group)
    {
        return self::getModel()
            ->where('group', $group)
            ->delete();
    }

    /**
     * Remove by id.
     *
     * @param $id
     * @return mixed
     */
    public function removeById($id)
    {
        return self::getModel()
            ->find($id)
            ->delete();
    }
    public function removeByKey($key)
    {
        return self::getModel()
            ->where('key_unique',$key)
            ->first()
            ->delete();
    }
    public function removeGroupById($group, $id)
    {
        return self::getModel()
            ->where('group', $group)
            ->where('metaable_id', $id)
            ->delete();
    }
}