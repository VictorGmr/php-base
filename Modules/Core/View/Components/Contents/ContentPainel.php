<?php

namespace Modules\Core\View\Components\Contents;

use Illuminate\View\Component;

class ContentPainel extends Component
{
    public $cols;
    public $response;

    public function __construct(
        $cols = 12,
        $response = null
    )
    {
        $this->cols = $cols;
        $this->response = $response;
    }

    public function render()
    {
        return view('core::components.contents.painel');
    }
}
