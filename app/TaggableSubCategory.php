<?php

namespace App;

use App\Libraries\WithoutTimestampsModel;

class TaggableSubCategory extends WithoutTimestampsModel
{
    /**
     * @var string
     */
    protected $table = 'taggable_tag_sub_categories';

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
        return $this->hasOne(SubCategory::class, 'sub_category_id', 'id');
    }
}