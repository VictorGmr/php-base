<?php

namespace Modules\Core\Abstratcs\Controller;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Core\Helpers\Application\ModuleConfig;
use Modules\Empreendimento\Enum\DomainsEnum;

class BaseController extends Controller
{
    public function flashError(string $type, string $prefix = "", string $sufix = "")
    {
        flash(ModuleConfig::getErrorMessage($this->getDomain(), $type,  $prefix,  $sufix))->error();
    }

    public function flashSuccess(string $type, string $prefix = "", string $sufix = "")
    {
        flash(ModuleConfig::getSuccessMessage($this->getDomain(), $type,  $prefix,  $sufix))->success();
    }
}
