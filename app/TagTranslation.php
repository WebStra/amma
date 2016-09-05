<?php

namespace App;

use App\Libraries\WithoutTimestampsModel;

class TagTranslation extends WithoutTimestampsModel
{
    /**
     * @var string
     */
    protected $table = 'taggable_tag_translations';

    /**
     * @var array
     */
    protected $fillable = [ 'language_id', 'taggable_id', 'name' ];
}