<?php

namespace Modules\Core\View\Components\Contents;

use Illuminate\View\Component;

class ContentResponse extends Component
{
    public function __construct()
    {

    }

    public function render()
    {
        return view('core::components.contents.response');
    }
}
