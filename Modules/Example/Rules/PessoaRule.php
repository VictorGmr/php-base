<?php

namespace Modules\Example\Rules;

use Modules\Example\Entities\Pessoa;
use Modules\Core\Abstratcs\Rules\BaseRules;

class PessoaRule extends BaseRules
{
    protected $table;
    protected $rules;

    public function __construct(Pessoa $pessoa)
    {
        $this->table = $pessoa->getTable();
        $this->rules = collect();

    }

    public function getRules($request = null)
    {
        return $this->rules
            ->merge($this->active())
            ->merge($this->name())
            ->toArray();
    }
}
