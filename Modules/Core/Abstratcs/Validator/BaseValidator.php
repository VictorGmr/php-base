<?php

namespace Modules\Core\Abstratcs\Validator;

use Illuminate\Support\Facades\Validator;

class BaseValidator
{
    public $model;
    public $rules;

    public function __construct($model, $rules)
    {
        $this->model = $model;
        $this->rules = $rules;
    }

    public function validateStore($data)
    {
        $validator = Validator::make($data, $this->rules->getStoreRules((object)$data));

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->toJson());
        }

        return $validator->validated();
    }

    public function validateUpdate($data)
    {
        $validator = Validator::make($data, $this->rules->getUpdateRules((object)$data));

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->toJson());
        }

        return $validator->validated();
    }

    public function validateDelete($model)
    {
        return $model;
    }
}
