<?php

namespace App\Libraries\MetaablePrice;

use App\Libraries\MetaablePrice\Repository as MetaRepository;

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
        if (!$meta = $this->getMeta($key, $group)) {
            return $this->getRepository()->create($this, $key, $value, $group);
        } else {
            return $this->updateMeta($meta, $key, $value);
        }
    }

    /**
     * Update Meta.
     * 
     * @param $meta
     * @param $key
     * @param $value
     * @param null $group
     * @return mixed
     */
    public function updateMeta($meta, $key, $value, $group = null)
    {
        if(is_numeric($meta))
            $meta = $this->getRepository()->getModel()->find((int) $meta)->first();

        $meta->key = $key;
        $meta->value = $value;
        if(isset($group))
            $meta->group = $group;

        $meta->save();
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
     * Alias for unsetMeta method.
     *
     * @param $key
     * @param null $group
     * @return mixed
     */
    public function removeMeta($key, $group = null)
    {
        if(isset($group))
            return $this->unsetMeta($key, $group);

        return $this->unsetMeta($key);
    }

    /**
     * Remove by id.
     * 
     * @param $id
     */
    public function removeMetaById($id)
    {
        $this->getRepository()->removeById((int) $id);
    }

    /**
     * Remove group of meta.
     *
     * @param $groups
     * @return $this
     */
    public function removeMetaGroups($groups)
    {
        if(is_array($groups)) {
            array_walk($groups, function ($group) {
                $this->getRepository()->removeGroup($group);
            });
        } else {
            $this->getRepository()->removeGroup($groups);
        }
        
        return $this;
    }

    /**
     * @param $group
     * @return $this
     */
    public function removeGroup($group)
    {
        return $this->removeMetaGroups($group);
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

    /**
     * @param $group
     * @return mixed
     */
    public function getMetaGroup($group)
    {
        return $this->getMetaFromGroup($group);
    }

    /**
     * Get meta repository
     *
     * @return Repository
     */
    private function getRepository()
    {
        return new MetaRepository();
    }
}