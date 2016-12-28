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
            return $this->meta()->whereKeyUnique($key)->first();

        return $this->meta()->whereKeyUnique($key)->group($group)->first();
    }

    /**
     * Set meta.
     *
     * @param $key
     * @param $value
     * @param null $group
     * @return mixed
     */
    public function setMeta($meta_data, $group = null)
    {
        if (!$meta = $this->getMeta($meta_data['key_unique'], $group)) {
            return $this->getRepository()->create($this, $meta_data, $group);
        } else {
            return $this->updateMeta($meta, $meta_data);
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
    public function updateMeta($meta, $meta_data, $group = null)
    {
        if(is_numeric($meta))
            $meta = $this->getRepository()->getModel()->find((int) $meta)->first();

        $meta->key   = $meta_data['key'];
        $meta->value = $meta_data['value'];
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
    public function removeMeta($meta_data, $group = null)
    {
        if(isset($group))
            return $this->unsetMeta($meta_data['key_unique'], $group);

        return $this->unsetMeta($meta_data['key_unique']);
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
    public function removeMetaByKey($key)
    {
        if ($this->getMeta($key)) {
            $this->getRepository()->removeByKey($key);
        }
    }
    public function removeMetaGroupById($group=null, $id=null)
    {
        if ($id!=null) {
            $this->getRepository()->removeGroupById($group,(int)$id);
        }
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
        return $this->meta()->group($group)->orderBy('id', 'asc')->get();
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