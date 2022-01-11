<?php

namespace Modules\Core\View\Components;

use Illuminate\View\Component;

abstract class BaseLinkComponent extends Component
{
    public function render()
    {
        return function (array $data) {
            return view($this->getView(), $this->mergeAttributes($data))->render();
        };
    }

    abstract protected function getView(): string;

    protected function sharedAttributes(): array
    {
        return ['name','id', 'disabled', 'readonly'];
    }

    protected function mergeAttributes(array $data): array
    {
        $attributes = $data['attributes'];
        $target = $attributes->wire('click')->value();
        $data['target'] = $target;
        return $data;
    }
}
