<?php

namespace Modules\Example\Services;

use Modules\Core\Abstratcs\Service\BaseService;
use Modules\Example\Repositories\Contracts\PessoaRepositoryInterface;
use Modules\Example\Services\Contracts\PessoaServiceInterface;
use Modules\Core\Traits\ServiceCommonTrait;

class PessoaService extends BaseService implements PessoaServiceInterface
{
    use ServiceCommonTrait;

    public $validator;

    public function __construct(
        PessoaRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function create($data)
    {
        try {
            return parent::create($data);
        } catch (\Exception $exception) {
            report($exception);
            throw $exception;
        }
    }

    public function merge($model, $data)
    {
        try {
            return parent::merge($model, $data);
        } catch (\Exception $exception) {
            report($exception);
            throw $exception;
        }
    }
}
