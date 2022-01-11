<?php

namespace Modules\Core\View\Components\Inputs;

class InputCNPJ extends InputText
{
    protected function getView(): string
    {
        return 'core::components.inputs.cnpj';
    }
}
