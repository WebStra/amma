<?php

namespace App;

use Keyhunter\Administrator\Repository;

class TaggableSubCategory extends Repository
{
    /**
     * @var string
     */
    protected $table = 'taggable_tag_sub_categories';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [ 'taggable_tag_id', 'sub_category_id' ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo(Tag::class, 'taggable_tag_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subCategory()
    {
        return $this->hasOne(SubCategory::class, 'id', 'sub_category_id');
    }
}