<?php

namespace App\Administrator\Types;

class TextSelect extends Element
{
    /**
     * @var array
     */
    protected $options = [];

    /**
     * Except attributes to insert.
     *
     * @var array
     */
    protected $exceptAttributes = [ 'stat', 'default' ];

    /**
     * Required attributes which can't be replaced.
     *
     * @var array
     */
    protected $requiredAttributes = [
        'style' => 'max-width: 300px',
        'data-input-type' => 'text_dropdown',
        'class' => 'ui fluid search selection dropdown'
    ];

    /**
     * Render input.
     *
     * @return string
     */
    public function renderInput()
    {
        $options = $this->getOptions();

        $html = sprintf('<div %s>', $this->renderAttributesAsHtml());
            $html .= '<input name="'. $this->getName() .'" type="hidden" ' . $this->renderValueAsHtml() . '>';
            $html .= '<i class="dropdown icon"></i>';
            $html .= '<div class="default text">' . $this->getDefaultText() . '</div>';
            $html .= '<div class="menu">';
                array_walk($options, function($option) use (&$html){
                    return $html .= sprintf("<div class=\"item\" data-value=\"%s\">%s</div>", $option, $option);
                });
            $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    /**
     * Get default text value.
     *
     * @param string $default
     * @return null
     */
    public function getDefaultText($default = 'default')
    {
        $attributes = $this->getAttributes();

        return isset($attributes[$default]) ? $attributes[$default] : null;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function getOptions()
    {
        if(is_callable($this->options))
            return call_user_func_array($this->options, array($this->getRepository()));

        return $this->options;
    }

    /**
     * Convert array attributes into html attributes.
     *
     * @return string
     */
    private function renderAttributesAsHtml()
    {
        $attributes = $this->cleanAttributes();
        $attributes = array_merge($attributes, $this->requiredAttributes);

        $string = '';

        array_walk($attributes, function($attrVal, $attrKey) use (&$string, $attributes) {
            if(end($attributes) !== $attrKey)
                return $string .= sprintf("%s=\"%s\" ", $attrKey, $attrVal);

            return $string .= sprintf("%s=\"%s\"", $attrKey, $attrVal);
        });

        return $string;
    }

    /**
     * Clear attributes.
     *
     * @return array
     */
    public function cleanAttributes()
    {
        $excepts = $this->exceptAttributes;

        $attributes = $this->getAttributes();

        array_walk($excepts, function($except) use (&$attributes){
            unset($attributes[$except]);
        });

        return $attributes;
    }

    /**
     * Render value as html attribute.
     *
     * @return string
     */
    private function renderValueAsHtml()
    {
        $value = $this->getValue();

        if($value !== null)
            return sprintf("value=\"%s\"", $value);

        return '';
    }
}