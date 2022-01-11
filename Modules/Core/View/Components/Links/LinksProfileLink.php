<?php

namespace Modules\Core\View\Components\Links;

use Modules\Core\View\Components\BaseLinkComponent;

class LinksProfileLink extends BaseLinkComponent
{
    protected function getView(): string
    {
        return 'core::components.links.profile-link';
    }
}
