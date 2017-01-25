<?php

namespace App\Http\ViewComposers;


use Illuminate\Contracts\View\View;
use File;
use Auth;

class InvolvedCountComposer extends Composer
{


    public function compose(View $view)
    {
        if (Auth::check()) {
            $involved = Auth::user()->involved()->active()->where('type', 'involve')->get();
            $i = 0;
            if (count($involved) > 0) {
                foreach ($involved as $item) {
                    if ($item->lot->verify_status == 'verified') {
                        $i++;
                    }
                }
            }
            return $view->with(['involvecount' => $i]);
        }
    }
}