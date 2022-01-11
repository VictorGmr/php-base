<?php

namespace Modules\Core\View\Components\Buttons;

use Modules\Core\View\Components\BaseButtonComponent;

class ButtonAction extends BaseButtonComponent
{
    public $label;
    public $loadingLabel;
    public $type;
    public $w;
    public $route;

    public function __construct(
        $label = "Button",
        $loadingLabel = null,
        $type = 'primary',
        $w = null,
        $route = null
    )
    {
        $this->label = $label;
        $this->type = $type;
        $this->w = $w;
        $this->route = $route;
        $this->loadingLabel = ($loadingLabel) ? $loadingLabel : $label;
    }

    protected function getView(): string
    {
        return 'core::components.buttons.action';
    }
}
