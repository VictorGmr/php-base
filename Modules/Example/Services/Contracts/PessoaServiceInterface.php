<?php

namespace Modules\Example\Services\Contracts;

use Modules\Core\Abstratcs\Interfaces\CrudInterface;

interface PessoaServiceInterface extends CrudInterface
{
    public function create($data);
    public function merge($model,$data);
    public function delete($model);
}
