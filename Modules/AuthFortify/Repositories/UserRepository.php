<?php

namespace Modules\AuthFortify\Repositories;

use Modules\AuthFortify\Entities\User;
use Modules\Core\Abstratcs\Repository\BaseRepository;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
