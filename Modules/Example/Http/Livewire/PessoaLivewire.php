<?php

namespace Modules\Example\Http\Livewire;

use Modules\Core\Abstratcs\Livewire\BaseLivewire;
use Modules\Example\Rules\PessoaRule;
use Modules\Example\Services\Contracts\PessoaServiceInterface;
use Modules\Example\Enum\DomainsExampleEnum;
use Modules\Core\Helpers\Application\ModuleConfig;
use Route;

class PessoaLivewire extends BaseLivewire
{
    protected $service;
    protected $modelRules;
    protected $redirectToList = true;

    public $pessoa;
    public $modelId;
    public $active = true;
    public $name;

    public function boot(
        PessoaServiceInterface $pessoaService,
        PessoaRule $pessoaRule
    )
    {
        $this->action = Route::getFacadeRoot()->current()->action['as'];
        ModuleConfig::setModuleDomain(
            config('example.alias'),
            DomainsExampleEnum::PESSOA
        );
        $this->service = $pessoaService;
        $this->modelRules = $pessoaRule;
    }

    public function mount($uuid = null)
    {
        try{
            if($uuid){
                $pessoa = $this->service->findByUuid($uuid);
                $this->modelId = $pessoa->id;
                $this->fill($pessoa);
                $this->pessoa = $pessoa;

            }
        }catch (\Exception $exception){
            $this->flashFailed($this->getExceptionMessage($exception));
            return redirect()->to(url()->previous());
        }
    }

    public function render()
    {
        return view('example::pessoa.livewire.pessoa');
    }

    /**
     * Actions
     */

    protected function prepareForValidation($attributes)
    {
        return $attributes;
    }
}
