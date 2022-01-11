<?php

namespace Modules\Core\Abstratcs\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class BaseModel extends Model
{
    protected $generateUuid = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function($model){
            if($model->generateUuid){
                $model->uuid = (string) Str::uuid();
            }
        });
    }
}
