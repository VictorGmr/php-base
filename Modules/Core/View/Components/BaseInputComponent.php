<?php

namespace Modules\Core\View\Components;

use Illuminate\View\Component;

abstract class BaseInputComponent extends Component
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
        $model      = $attributes->wire('model')->value();

        if (!$attributes->has('name') && $model) {
            $attributes->offsetSet('name', $model);
        }

        if (!$attributes->has('id') && $model) {
            $attributes->offsetSet('id', $attributes->get('name'));
        }

        foreach ($this->sharedAttributes() as $attribute) {
            $data[$attribute] = $attributes->get($attribute);
        }
        return $data;
    }
}
