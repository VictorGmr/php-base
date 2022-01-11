<?php

namespace Modules\Core\Http\Livewire\Traits;

trait NotifyTrait
{
    protected $dispatch = 'notify';

    /**
     * Notify
     */
    public function notifySuccess($message, $title = 'Sucesso')
    {
        $this->dispatchBrowserEvent($this->dispatch,[
            'type' => 'success',
            'title' => $title,
            'message' => $message
        ]);
    }

    public function notifyFailed($message, $title = 'Falha')
    {
        $this->dispatchBrowserEvent($this->dispatch,[
            'type' => 'failed',
            'title' => $title,
            'message' => $message
        ]);
    }

    /**
     * Flash Message
     */

    public function flashSuccess($message)
    {
        session()->flash('message', [
            'type' => 'alert-success',
            'ico' => 'triangle',
            'msg' => $message,
        ]);
    }

    public function flashFailed($message)
    {
        session()->flash('message', [
            'type' => 'alert-danger',
            'ico' => 'octagon',
            'msg' => $message,
        ]);
    }

    public function flashWarning($message)
    {
        session()->flash('message', [
            'type' => 'alert-warning',
            'ico' => 'circle',
            'msg' => $message,
        ]);
    }
}
