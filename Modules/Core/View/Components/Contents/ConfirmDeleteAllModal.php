<?php

namespace Modules\Core\View\Components\Contents;

use Illuminate\View\Component;

class ConfirmDeleteAllModal extends Component
{
    public $countItens;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($countItens = 0)
    {
        $this->countItens = $countItens;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('core::components.contents.confirm-delete-all-modal');
    }
}
