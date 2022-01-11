<?php

namespace Modules\Example\Repositories;

use Modules\Core\Abstratcs\Repository\BaseRepository;
use Modules\Example\Entities\Pessoa;
use Modules\Example\Repositories\Contracts\PessoaRepositoryInterface;

class PessoaRepository extends BaseRepository implements PessoaRepositoryInterface
{
    public function __construct(Pessoa $model)
    {
        $this->model = $model;
    }
}
