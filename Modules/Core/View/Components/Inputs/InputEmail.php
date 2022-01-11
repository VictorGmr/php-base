<?php

namespace Modules\Core\View\Components\Inputs;

class InputEmail extends InputText
{
    protected function getView(): string
    {
        return 'core::components.inputs.email';
    }
}
