<?php

namespace App\Libraries\Taggable;

use App\Tag;
use Cviebrock\EloquentTaggable\Services\TagService as BaseTagService;

class TagService extends BaseTagService
{
    /**
     * Find an existing tag by name.
     *
     * @param string $tagName
     *
     * @return Tag|null
     */
    public function find($tagName)
    {
        $normalized = $this->normalize($tagName);

        return Tag::where('normalized', $normalized)->first();
    }
}