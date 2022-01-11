<?php

namespace Modules\Core\View\Components\Contents;

use Illuminate\View\Component;

class ContentTitle extends Component
{
    public $cols;

    public function __construct($cols = 12)
    {
        $this->cols = $cols;
    }

    public function render()
    {
        return view('core::components.contents.title');
    }
}
