<?php

namespace Modules\Core\Http\Livewire\Traits;

use Modules\Core\DefaultMessages\GlobalMessages;
use Modules\Core\Helpers\Application\ModuleConfig;

trait ConfirmModalTrait
{
    public $itemName;
    public $selectedItem;
    public $message = "";
    public $currentStatus;

    abstract function query();

    /**
     * Delete Item Modal
     */
    public function confirmDeleteItemModal($itemName, $selectedItem)
    {
        $this->selectedItem = $selectedItem;
        $this->message = ModuleConfig::getErrorMessage(GlobalMessages::CONFIRM_DELETE, sufix: '<br><b>'.$itemName.'</b>');
        $this->dispatchBrowserEvent('modal-show-delete-single',[]);
    }

    public function deleteItem()
    {
        try{
            $model = $this->service->findByUuid($this->selectedItem);
            $this->service->delete($model);
            $this->notifySuccess(ModuleConfig::getSuccessMessage(GlobalMessages::DELETE_SUCCESS, sufix: '!'));
        }catch (\Exception $exception){
            $this->notifyFailed(ModuleConfig::getErrorMessage(GlobalMessages::DELETE_ERROR, sufix: '!'));
        }
        $this->dispatchBrowserEvent('modal-hidden-delete-single',[]);
        $this->emit('refreshDatatable');
    }

    /**
     * Delete All Item Modal
     */

    public function confirmDeleteAllItensModal()
    {
        $this->totalItensKeys = count($this->selectedKeys);
        $this->message = ModuleConfig::getErrorMessage(GlobalMessages::CONFIRM_DELETE_ALL,
            sufix: '?',
            replace: ['$QTD$' => $this->totalItensKeys],
            numberLabel: 'plural'
        );
        $this->dispatchBrowserEvent('modal-show-delete-all',[]);
    }

    public function deleteAllItem()
    {
        try{
            $this->service->deleteBatch($this->getCheckedsItens());
            $this->resetBulk();
            $this->notifySuccess(ModuleConfig::getSuccessMessage(GlobalMessages::DELETE_SUCCESS_ALL, sufix: '!'));
        }catch (\Exception $exception){
            $this->notifyFailed(ModuleConfig::getErrorMessage(GlobalMessages::DELETE_ERROR, sufix: '!'));
        }
        $this->dispatchBrowserEvent('modal-hidden-delete-all',[]);
        $this->emit('refreshDatatable');
    }


    /**
     * Confirm Change Status Single
     */

    public function confirmChangeStatusItemModal($itemName, $selectedItem, $active)
    {
        $this->selectedItem = $selectedItem;
        $this->currentStatus = !$active;
        $status = ($active) ? 'Desativar' : 'Ativar';
        $style = ($active) ? 'text-theme-6' : 'text-theme-9';
        $this->message = ModuleConfig::getErrorMessage(GlobalMessages::CONFIRM_ENABLE,
            sufix: '<br><b>'.$itemName.'</b>',
            replace: ['$STATUS$' => $status,'$STYLE$' => $style]
        );
        $this->dispatchBrowserEvent('modal-show-warning-single',[]);
    }

    public function changeStatusItem()
    {
        $model = $this->service->findByUuid($this->selectedItem);
        $this->service->merge($model, ["active" => !$model->active]);
        $this->resetBulk();
        $this->dispatchBrowserEvent('modal-hidden-warning-single',[]);
        if($this->currentStatus){
            $this->notifySuccess(ModuleConfig::getSuccessMessage(GlobalMessages::ENABLE_SUCCESS, sufix: '!'));
        }else{
            $this->notifySuccess(ModuleConfig::getSuccessMessage(GlobalMessages::DISABLE_SUCCESS, sufix: '!'));
        }
        $this->emit('refreshDatatable');
    }

    /**
     * Confirm Change Status All Itens
     */


    public function confirmChangeStatusAllItensModal()
    {
        $this->totalItensKeys = count($this->selectedKeys);
        $this->message = 'Deseja mudar o status de <b>'.$this->totalItensKeys.'</b> registro(s)?';
        $this->dispatchBrowserEvent('modal-show-warning-all',[]);
    }

    public function changeStatusAllItens()
    {
        $this->service->changeStatusBatch($this->getCheckedsItens());
        $this->resetBulk();
        $this->dispatchBrowserEvent('modal-hidden-warning-all',[]);
        $this->notifySuccess("Status alterados com sucesso!");
        $this->emit('refreshDatatable');
    }
}
