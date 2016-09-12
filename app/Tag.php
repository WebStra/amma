<?php

namespace App;

use App\Libraries\Presenterable\Presenterable;
use App\Libraries\Presenterable\Presenters\TagPresenter;
use App\Traits\ActivateableTrait;
use Cviebrock\EloquentTaggable\Services\TagService;
use Keyhunter\Administrator\Repository;
use Keyhunter\Translatable\HasTranslations;
use Keyhunter\Translatable\Translatable;

class Tag extends Repository implements Translatable
{
    use HasTranslations, ActivateableTrait, Presenterable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'taggable_tags';

    /**
     * @var TagPresenter
     */
    public $presenter = TagPresenter::class;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'category_id', 'normalized', 'active' ];

    /**
     * Set the name attribute on the model.
     *
     * @param string $value
     */
    public function setNameAttribute($value)
    {
        $value = trim($value);
        $this->attributes['name'] = $value;
        $this->attributes['normalized'] = app(TagService::class)->normalize($value);
    }

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [ 'name', 'group' ];

    /**
     * @var \Illuminate\Database\Eloquent\Model TagTranslation
     */
    public $translationModel = TagTranslation::class;

    /**
     * Convert the model to its string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getAttribute('name');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}