<?php

namespace Modules\Core\View\Components\Buttons;

use Modules\Core\View\Components\BaseButtonComponent;

class ButtonSave extends BaseButtonComponent
{
    public $label;
    public $loadingLabel;
    public $type;

    public function __construct(
        $label = "Button",
        $loadingLabel = null,
        $type = 'primary'
    )
    {
        $this->label = $label;
        $this->type = $type;
        $this->loadingLabel = ($loadingLabel) ? $loadingLabel : $label;
    }

    protected function getView(): string
    {
        return 'core::components.buttons.save';
    }
}
