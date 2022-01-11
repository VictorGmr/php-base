<?php

namespace Modules\Core\View\Components\Contents;

use Illuminate\View\Component;

class ConfirmModal extends Component
{
    public $name;
    public $type;
    public $message;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $name,
        $type,
        $message = ""
    )
    {
        $this->name = $name;
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('core::components.contents.confirm-modal');
    }
}
