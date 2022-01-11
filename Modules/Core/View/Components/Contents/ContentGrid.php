<?php

namespace Modules\Core\View\Components\Contents;

use Illuminate\View\Component;

class ContentGrid extends Component
{
    public $cols;
    public $mt;
    public $gap;

    public function __construct(
        $cols = 12,
        $mt = 5,
        $gap = 6
    )
    {
        $this->cols = $cols;
        $this->mt = $mt;
        $this->gap = $gap;
    }

    public function render()
    {
        return view('core::components.contents.grid');
    }
}
