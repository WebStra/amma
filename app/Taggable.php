<?php

namespace App;

use Keyhunter\Administrator\Repository;

class Taggable extends Repository
{
    protected $table = 'taggable_taggables';

    protected $fillable = [ 'tag_id', ''];
}