<?php

namespace Modules\AuthFortify\Services;

use Laravel\Fortify\Contracts\CreatesNewUsers;
use Modules\AuthFortify\Repositories\UserRepository;
use Modules\Core\Abstratcs\Service\BaseService;
use Modules\Core\Traits\ServiceCommonTrait;

class UserService extends BaseService
{
    use ServiceCommonTrait;

    public $createsNewUsers;

    public function __construct(
        UserRepository $repository,
        CreatesNewUsers $createsNewUsers
    )
    {
        $this->repository = $repository;
        $this->createsNewUsers = $createsNewUsers;
    }
}
