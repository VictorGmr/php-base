<?php

namespace Modules\Core\Abstratcs\Interfaces;

interface CrudInterface
{
    public function create($data);
    public function merge($model, $id);
    public function delete($model);
}
