<?php

namespace Modules\Core\View\Components\Contents;

use Illuminate\View\Component;

class PageHeader extends Component
{
    public $number;

    public function __construct(
        $number = 'single'
    )
    {
        $this->number = $number;
    }

    public function render()
    {
        return view('core::components.contents.header');
    }
}
