<?php

namespace Modules\Core\View\Components\Inputs;

use Modules\Core\View\Components\BaseInputComponent;

class InputText extends BaseInputComponent
{
    public ?string $label;
    public ?string $hint;
    public ?string $icon;
    public ?string $cols;
    public $mt;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        ?string $label = null,
        ?string $hint = null,
        ?string $icon = null,
        ?string $cols = null,
        $mt = 3,
        $required = null
    )
    {
        $this->label     = trim($label);
        $this->hint      = (!$required) ? trim($hint) : '*Obrigatório';
        $this->icon      = trim($icon);
        $this->cols      = trim($cols);
        $this->mt        = trim($mt);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    protected function getView(): string
    {
        return 'core::components.inputs.text';
    }
}
