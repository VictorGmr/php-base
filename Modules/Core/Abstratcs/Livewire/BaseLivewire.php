<?php

namespace Modules\Core\Abstratcs\Livewire;

use Livewire\Component;
use Modules\Core\DefaultMessages\GlobalMessages;
use Modules\Core\Helpers\Application\ModuleConfig;
use Modules\Core\Http\Livewire\Traits\NotifyTrait;

abstract class BaseLivewire extends Component
{
    use NotifyTrait;

    protected $service;
    protected $modelRules;
    protected $success = false;
    protected $msg = "";
    protected $redirectToList = false;

    public $action;
    public $modelId;


    public function save()
    {
        $this->success = false;

        if(!$this->modelId){
            $validated = $this->validate($this->modelRules->getRules($this));
            try{
                $this->service->create($validated);
                $this->success = true;
                $this->msg = ModuleConfig::getSuccessMessage(GlobalMessages::CREATE_SUCCESS, sufix: ".");
            }catch (\Exception $exception){
                $this->setErroMessage($exception);
            }
            $this->feedBackToView();
        }else{
            $this->update();
        }
    }

    public function update()
    {
        $validated = $this->validate($this->modelRules->getRules($this));
        try{
            $model = $this->service->find($this->modelId);
            $this->service->merge($model, $validated);
            $this->success = true;
            $this->msg = ModuleConfig::getSuccessMessage(GlobalMessages::EDIT_SUCCESS, sufix: ".");
        }catch (\Exception $exception){
            $this->setErroMessage($exception);
        }

        $this->feedBackToView();
    }

    protected function getExceptionMessage(\Exception $exception)
    {
        if(config('systemconfig.app_env') == "production"){
            return "Não foi possível concluir a operação";
        }
        return $exception->getMessage();
    }

    private function setErroMessage($exception)
    {
        $this->msg = $this->getExceptionMessage($exception);
        $this->addError('request', $this->msg);
    }

    private function feedBackToView()
    {
        if($this->redirectToList && $this->success){
            $this->flashSuccess($this->msg);
            return redirect()->route(ModuleConfig::$domain.'-list');
        }else{
            if($this->success){
                $this->notifySuccess($this->msg);
            }else{
                $this->notifyFailed($this->msg);
            }
        }
    }
}
