<?php

namespace Modules\Core\View\Components\Inputs;

class InputCPF extends InputText
{
    protected function getView(): string
    {
        return 'core::components.inputs.cpf';
    }
}
