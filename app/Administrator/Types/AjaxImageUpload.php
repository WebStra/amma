<?php

namespace App\Administrator\Types;

class AjaxImageUpload extends Element
{
    protected $defaultAttributes = [
        'multiple' => "false"
    ];

    public function renderInput()
    {
//        $value = 1;

//        dd($this->name);
//        dd($this->attributesToHtml());

        return view('administrator::types.ajax_image_upload', [
            'name' => $this->name,
            'value' => $this->value,
        ]);
    }

    public function getAttributes()
    {
        return array_merge($this->defaultAttributes, $this->attributes);
    }

    /**
     * Get default attributes.
     *
     * @return array
     */
    public function getDefaultAttributes()
    {
        return $this->defaultAttributes;
    }
}