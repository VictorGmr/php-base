<?php

namespace Modules\Core\View\Components\Contents;

use Illuminate\View\Component;

class ConfirmDeleteModal extends Component
{
    public $message;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $message = ""
    )
    {
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('core::components.contents.confirm-delete-modal');
    }
}
