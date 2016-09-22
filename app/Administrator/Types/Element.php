<?php

namespace App\Administrator\Types;

use Keyhunter\Administrator\Form\Element as BaseElement;

abstract class Element extends BaseElement
{
    public function getAttributes()
    {
        return $this->attributes;
    }

    public function attributesToHtml($attributes = null)
    {
        if(! $attributes)
            $attributes = $this->getAttributes();

        $html = '';
        $i = 1;
        array_walk($attributes, function ($attr, $k) use (&$html, &$i, $attributes){
            $template = sprintf("%s=\"%s\"", $k, $attr);

            if($i == 1){
                $html .= $template;
            }else{
                $html .= " " . $template;
            }

            $i++;
        });

        return $html;
    }
}