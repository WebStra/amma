<?php
namespace App;

use App\Libraries\WithoutTimestampsModel;

class VideoTranslations extends WithoutTimestampsModel
{
    /**
     * @var string
     */
    protected $table = 'video_translations';

    /**
     * @var array
     */
    protected $fillable = ['language_id', 'video_id', 'video1', 'video2'];
}
