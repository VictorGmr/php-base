<?php

namespace Modules\Core\View\Components\Inputs;

class InputPhone extends InputText
{
    protected function getView(): string
    {
        return 'core::components.inputs.phone';
    }
}
