<?php
namespace App;
namespace App;
use Keyhunter\Administrator\Repository;
use Keyhunter\Translatable\HasTranslations;
use App\Traits\ActivateableTrait;
class Unit extends Repository
{
    use HasTranslations,ActivateableTrait;

    /**
     * @var MenuTranslations
     */
    public $translationModel = UnitTranslation::class;

    protected $presenter = MainPresenter::class;

    /**
     * @var string
     */
    protected $table = 'units';

    /**
     * @var array
     */

    protected $fillable = [];

    /**
     * @var array
     */
    public $translatedAttributes = ['name','unit_id','language_id'];
/*
    public function scheduleAdult()
    {
        return $this->hasMany(Schedule::class, 'unit_id', 'id')->active()->where('type','adult')->orderBy('hour','asc');
    }
    public function scheduleKids()
    {
        return $this->hasMany(Schedule::class, 'unit_id', 'id')->active()->where('type','kids')->orderBy('hour','asc');
    }*/
    public function delete(){
        if($this->attributes['image']){
            $file = $this->attributes['image'];
            if(File::exists(public_path($file))){
                \File::delete(public_path($file));
            }
        }
        parent::delete();
    }
}

