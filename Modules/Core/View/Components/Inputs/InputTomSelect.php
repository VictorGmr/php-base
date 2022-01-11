<?php

namespace Modules\Core\View\Components\Inputs;

use Modules\Core\View\Components\BaseInputComponent;

class InputTomSelect extends BaseInputComponent
{
    public $options;
    public ?string $label;
    public ?string $valueField;
    public ?string $labelField;
    public ?string $placeholder;
    public ?string $hint;
    public ?string $icon;
    public $multiple;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $options = [],
        ?string $optionkey = 'id',
        ?string $optionlabel = 'name',
        ?string $placeholder = null,
        ?string $label = null,
        ?string $hint = null,
        ?string $icon = null,
        $required = null,
        $multiple = null
    )
    {
        $this->label            = trim($label);
        $this->valueField       = trim($optionkey);
        $this->labelField       = trim($optionlabel);
        $this->placeholder      = trim($placeholder);
        $this->options          = $options;
        $this->hint             = (!$required) ? trim($hint) : '*Obrigatório';
        $this->icon             = $icon;
        $this->multiple         = $multiple;
        $this->prepareOptions();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    protected function getView(): string
    {
        return 'core::components.inputs.tom-select';
    }

    public function prepareOptions()
    {
        $currentKey = $this->valueField;
        $currentValue = $this->labelField;
        $this->options = collect($this->options)->map(function ($value) use($currentKey, $currentValue){
            $key = (is_object($value)) ? $value->$currentKey : $value[$currentKey];
            $label = (is_object($value)) ? $value->$currentValue : $value[$currentValue];
            return ['key' => $key,'label' => $label];
        })->toArray();
    }
}
