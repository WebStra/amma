<?php

namespace App\Libraries\Metaable;

use App\Libraries\Metaable\Repository as MetaRepository;

trait HasMeta
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\morphMany
     */
    public function meta()
    {
        return $this->morphMany(Meta::class, 'metaable');
    }

    /**
     * Get meta by key.
     *
     * @param $key
     * @param $group null
     * @return mixed
     */
    public function getMeta($key, $group = null)
    {
        if (is_null($group))
            return $this->meta()->whereKey($key)->first();

        return $this->meta()->whereKey($key)->group($group)->first();
    }

    /**
     * Set meta.
     *
     * @param $key
     * @param $value
     * @param null $group
     * @return mixed
     */
    public function setMeta($key, $value, $group = null)
    {
        if (!$meta = $this->getMeta($key, $group))
            return (new MetaRepository)->create($this, $key, $value, $group);

        return $meta;
    }

    /**
     * Delete meta.
     *
     * @param $key
     * @param null $group
     * @return mixed
     */
    public function unsetMeta($key, $group = null)
    {
        return $this->getMeta($key, $group)->delete();
    }

    /**
     * Remove group of meta.
     *
     * @param $group
     * @return $this
     */
    public function removeMetaGroup($group)
    {
        (new MetaRepository)->removeGroup($group);

        return $this;
    }

    /**
     * Get other meta.
     *
     * @return mixed
     */
    public function getOtherMeta()
    {
        return $this->getMetaFromGroup('other');
    }

    /**
     * Get other meta.
     *
     * @alias: self::getOtherMeta()
     * @return mixed
     */
    public function getSimpleMeta()
    {
        return $this->getOtherMeta();
    }

    /**
     * Get other meta.
     *
     * @return mixed
     */
    public function metaWithoutGroup()
    {
        return $this->getOtherMeta();
    }

    /**
     * Get all meta from specific group.
     *
     * @param $group
     * @return mixed
     */
    public function getMetaFromGroup($group)
    {
        return $this->meta()->group($group)->get();
    }
}