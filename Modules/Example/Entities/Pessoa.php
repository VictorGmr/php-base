<?php

namespace Modules\Example\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Core\Abstratcs\Model\BaseModel;
use Modules\Example\Database\factories\PessoaFactory;

class Pessoa extends BaseModel
{
    use HasFactory;

    protected $table = 'exp_pessoa';
    protected $generateUuid = true;

    public $fillable = [
        'name',
        'active',
    ];

    public static function newFactory()
    {
        return PessoaFactory::new();
    }
}
