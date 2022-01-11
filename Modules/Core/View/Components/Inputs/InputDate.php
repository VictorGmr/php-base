<?php

namespace Modules\Core\View\Components\Inputs;

class InputDate extends InputText
{
    protected function getView(): string
    {
        return 'core::components.inputs.date';
    }
}
