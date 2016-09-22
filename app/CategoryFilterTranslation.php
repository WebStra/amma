<?php

namespace App;

use App\Libraries\WithoutTimestampsModel;

class CategoryFilterTranslation extends WithoutTimestampsModel
{
    /**
     * @var string
     */
    protected $table = 'category_filter_translations';

    /**
     * @var array
     */
    protected $fillable = ['langage_id', 'category_filter_id', 'name'];
}