<?php

namespace Modules\Core\View\Components\Inputs;

use Modules\Core\View\Components\BaseInputComponent;

class InputSwitch extends BaseInputComponent
{
    public ?string $label;
    public ?string $desc;
    public ?string $cols;
    public $mt;
    public $onLabel;
    public $offLabel;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        ?string $label = null,
        ?string $desc = null,
        ?string $cols = null,
        $mt = 3,
        $onLabel = 'Ativo',
        $offLabel = 'Inativo'
    )
    {
        $this->label     = trim($label);
        $this->desc      = trim($desc);
        $this->cols      = trim($cols);
        $this->mt      = trim($mt);
        $this->onLabel  = trim($onLabel);
        $this->offLabel = trim($offLabel);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    protected function getView(): string
    {
        return 'core::components.inputs.switch';
    }
}
