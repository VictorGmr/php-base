<?php

namespace Modules\Core\View\Components\Links;

use Modules\Core\View\Components\BaseLinkComponent;

class StatusLink extends BaseLinkComponent
{
    public $active;
    public function __construct(
            $active = true
    )
    {
        $this->active = $active;
    }

    protected function getView(): string
    {
        return 'core::components.links.status';
    }
}
