<?php
namespace App;

use App\Libraries\WithoutTimestampsModel;

class UnitTranslation extends WithoutTimestampsModel
{
    public $timestamps  = false;
    protected $table    = 'units_translations';
    protected $fillable = ['name','language_id','day_id'];
}
