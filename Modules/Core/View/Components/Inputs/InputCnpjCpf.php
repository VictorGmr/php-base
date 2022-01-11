<?php

namespace Modules\Core\View\Components\Inputs;

class InputCnpjCpf extends InputText
{
    protected function getView(): string
    {
        return 'core::components.inputs.cnpj-cpf';
    }
}
