<?php

use Modules\Core\DefaultMessages;
use Modules\Example\Enum;

return [
    'name' => 'Example',
    'alias' => 'example',
    'table_prefix' => 'exp_',
    'domains' => [
        Enum\DomainsExampleEnum::PESSOA => [
            'single' => 'pessoa',
            'plural' => 'Pessoas',
            'messages' => DefaultMessages\DefaultMessages::DOMAINS_MESSAGES_FEMALE,
        ]
    ],
    'livewire' => [],
];
