<?php

namespace Modules\Core\Abstratcs\Rules;

use Illuminate\Validation\Rule;
use LaravelLegends\PtBrValidator\Rules\Cnpj;
use LaravelLegends\PtBrValidator\Rules\Cpf;
use LaravelLegends\PtBrValidator\Rules\CpfOuCnpj;
use LaravelLegends\PtBrValidator\Rules\FormatoCnpj;
use LaravelLegends\PtBrValidator\Rules\FormatoCpf;
use LaravelLegends\PtBrValidator\Rules\FormatoCpfOuCnpj;

abstract class BaseRules
{
    protected $table;

    public function active()
    {
        return ["active" => [
            'required',
            'max:20',
        ]];
    }

    public function name($nullable = false, $max = 50)
    {
        return ["name" => [
            (!$nullable) ? 'required' : 'nullable',
            'max:'.$max,
        ]];
    }

    public function alias($request = null, $nullable = false, $max = 50)
    {
        return ["alias" => [
            (!$nullable) ? 'required' : 'nullable',
            'max:'.$max,
            Rule::unique($this->table, 'alias')->ignore($request->modelId,'id'),
        ]];
    }

    public function cnpj($request = null, $nullable = false, $max = 14)
    {
        return ["cnpj" => [
            (!$nullable) ? 'required' : 'nullable',
            'max:'.$max,
            Rule::unique($this->table, 'cnpj')->ignore($request->modelId,'id'),
            //new FormatoCnpj(),
            new Cnpj(),
        ]];
    }

    public function cpf($request = null, $nullable = false, $max = 11)
    {
        return ["cpf" => [
            (!$nullable) ? 'required' : 'nullable',
            'max:'.$max,
            Rule::unique($this->table, 'cnpj')->ignore($request->modelId,'id'),
            //new FormatoCpf(),
            new Cpf(),
        ]];
    }

    public function cnpj_cpf($request = null, $nullable = false, $max = 14)
    {
        return ["cnpj_cpf" => [
            (!$nullable) ? 'required' : 'nullable',
            'max:'.$max,
            Rule::unique($this->table, 'cnpj_cpf')->ignore($request->modelId,'id'),
            //new FormatoCpfOuCnpj(),
            new CpfOuCnpj(),
        ]];
    }

    public function state($request, $nullable = false)
    {
        return ["state" => [
            (!$nullable) ? 'required' : 'nullable',
            'int',
            Rule::exists(config("contactdata.table_prefix").'states','id')->where(function ($query) use($request) {
                return $query->whereId($request->state);
            }),
        ]];
    }

    public function city($request, $nullable = false, $field = 'city')
    {
        return [$field => [
            (!$nullable) ? 'required' : 'nullable',
            'int',
            Rule::exists(config("contactdata.table_prefix").'cities','id')->where(function ($query) use($request, $field) {
                return $query->whereId($request->$field);
            }),
        ]];
    }
}
