<?php

use Modules\Core\View\Components;

return [
    'name' => 'Core',
    'components' => [
        //Contents
        'contents.painel' => [
            'class' => Components\Contents\ContentPainel::class,
            'alias' => 'contents.painel',
        ],
        'contents.response' => [
            'class' => Components\Contents\ContentResponse::class,
            'alias' => 'contents.response',
        ],
        'contents.grid' => [
            'class' => Components\Contents\ContentGrid::class,
            'alias' => 'contents.grid',
        ],
        'contents.profile-menu' => [
            'class' => Components\Contents\ContentProfileMenu::class,
            'alias' => 'contents.profile-menu',
        ],
        'contents.profile-info' => [
            'class' => Components\Contents\ContentProfileInfo::class,
            'alias' => 'contents.profile-info',
        ],
        'contents.profile-tab' => [
            'class' => Components\Contents\ContentProfileTab::class,
            'alias' => 'contents.profile-tab',
        ],
        'contents.title' => [
            'class' => Components\Contents\ContentTitle::class,
            'alias' => 'contents.title',
        ],
        'contents.confirm-delete-modal' => [
            'class' => Components\Contents\ConfirmDeleteModal::class,
            'alias' => 'contents.confirm-delete-modal',
        ],
        'contents.confirm-delete-all-modal' => [
            'class' => Components\Contents\ConfirmDeleteAllModal::class,
            'alias' => 'contents.confirm-delete-all-modal',
        ],
        'contents.confirm-modal' => [
            'class' => Components\Contents\ConfirmModal::class,
            'alias' => 'contents.confirm-modal',
        ],
        'contents.page-header' => [
            'class' => Components\Contents\PageHeader::class,
            'alias' => 'contents.page-header',
        ],

        //Inputs
        'inputs.text' => [
            'class' => Components\Inputs\InputText::class,
            'alias' => 'inputs.text',
        ],
        'inputs.password' => [
            'class' => Components\Inputs\InputPassword::class,
            'alias' => 'inputs.password',
        ],
        'inputs.email' => [
            'class' => Components\Inputs\InputEmail::class,
            'alias' => 'inputs.email',
        ],
        'inputs.phone' => [
            'class' => Components\Inputs\InputPhone::class,
            'alias' => 'inputs.phone',
        ],
        'inputs.date' => [
            'class' => Components\Inputs\InputDate::class,
            'alias' => 'inputs.date',
        ],
        'inputs.datepicker' => [
            'class' => Components\Inputs\InputDatePicker::class,
            'alias' => 'inputs.datepicker',
        ],
        //https://gist.github.com/mithicher/9944232624cbad4b1cb5d3d2cac87a97
        'inputs.tom-select' => [
            'class' => Components\Inputs\InputTomSelect::class,
            'alias' => 'inputs.tom-select',
        ],
        'inputs.switch' => [
            'class' => Components\Inputs\InputSwitch::class,
            'alias' => 'inputs.switch',
        ],
        'inputs.cnpj' => [
            'class' => Components\Inputs\InputCNPJ::class,
            'alias' => 'inputs.cnpj',
        ],
        'inputs.cpf' => [
            'class' => Components\Inputs\InputCPF::class,
            'alias' => 'inputs.cpf',
        ],
        'inputs.cnpj-cpf' => [
            'class' => Components\Inputs\InputCnpjCpf::class,
            'alias' => 'inputs.cnpj-cpf',
        ],

        //Buttons
        'buttons.save' => [
            'class' => Components\Buttons\ButtonSave::class,
            'alias' => 'buttons.save',
        ],
        'buttons.action' => [
            'class' => Components\Buttons\ButtonAction::class,
            'alias' => 'buttons.action',
        ],

        //Links
        'links.status' => [
            'class' => Components\Links\StatusLink::class,
            'alias' => 'links.status',
        ],

        'links.profile-link' => [
            'class' => Components\Links\LinksProfileLink::class,
            'alias' => 'links.profile-link',
        ],
    ],
];
