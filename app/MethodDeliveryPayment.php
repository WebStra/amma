<?php
namespace App;
use Keyhunter\Administrator\Repository;
use Keyhunter\Translatable\HasTranslations;
use App\Traits\ActivateableTrait;
class MethodDeliveryPayment extends Repository
{
    use HasTranslations,ActivateableTrait;

    public $translationModel = MethodDeliveryPaymentTransaltion::class;
    /**
     * @var string
     */
    protected $table = 'method_delivery_payment';

    /**
     * @var array
     */

    protected $fillable = ['active','type','ico'];

    /**
     * @var array
     */
    public $translatedAttributes = ['name'];
    
    public function getImageAttribute($value)
    {
        //add full path to image
      if (!empty($value)) {
        return str_replace('\\', '/', $value);
      }
    }

    public function delete(){
        if($this->attributes['ico']){
            $file = $this->attributes['ico'];
            if(File::exists(public_path($file))){
                \File::delete(public_path($file));
            }
        }
        parent::delete();
    }
}
