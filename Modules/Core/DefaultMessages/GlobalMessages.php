<?php

namespace Modules\Core\DefaultMessages;

use MyCLabs\Enum\Enum;

final class GlobalMessages extends Enum
{
    const CREATE_SUCCESS                    =   'CREATE_SUCCESS';
    const CREATE_ERROR                      =   'CREATE_ERROR';

    const EDIT_SUCCESS                      =   'EDIT_SUCCESS';
    const EDIT_ERROR                        =   'EDIT_ERROR';

    const ENABLE_SUCCESS                    =   'ENABLE_SUCCESS';
    const ENABLE_ERROR                      =   'DISABLE_ERROR';

    const DISABLE_SUCCESS                   =   'DISABLE_SUCCESS';
    const DISABLE_ERROR                     =   'DISABLE_ERROR';

    const DELETE_SUCCESS                    =   'DELETE_SUCCESS';
    const DELETE_SUCCESS_ALL                =   'DELETE_SUCCESS_ALL';
    const DELETE_ERROR                      =   'DELETE_ERROR';

    const SEARCH_ERROR                      =   'SEARCH_ERROR';
    const ELEMENT_NOT_FOUND                 =   'ELEMENT_NOT_FOUND';

    const CONFIRM_ENABLE                    =   'CONFIRM_ENABLE';
    const CONFIRM_DISABLE                   =   'CONFIRM_DISABLE';

    const CONFIRM_DELETE                    =   'CONFIRM_DELETE';
    const CONFIRM_DELETE_ALL                =   'CONFIRM_DELETE_ALL';
}
