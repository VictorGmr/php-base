<?php

use Modules\AuthFortify\Enum;
use Modules\Core\DefaultMessages;

return [
    'name' => 'AuthFortify',
    'alias' => 'authfortify',
    'table_prefix' => 'ath_',
    'domains' => [
        Enum\DomainsUserEnum::USER => [
            'single' => 'Usuário',
            'plural' => 'Usuários',
            'messages' => DefaultMessages\DefaultMessages::DOMAINS_MESSAGES_MALE,
        ]
    ],
];
