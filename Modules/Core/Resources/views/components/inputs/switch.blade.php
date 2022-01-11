<div class="mt-{{$mt}} @if($cols) col-span-12 lg:col-span-{{$cols}} @endif" x-data="{active: @entangle($attributes->wire('model'))}">
    @if($label) <label>{{$label}}</label> @endif
    <div class="mt-2">
        <div class="form-check">
            <input {!! $attributes->merge(['class' => 'form-check-switch']) !!} type="checkbox" @click="active = !active">
            <label class="form-check-label" for="{{$attributes->get('id')}}" x-text="active == true ? '{{$onLabel}}' : '{{$offLabel}}'"></label>
        </div>
        @if($errors->has($name))
            @foreach($errors->get($name) as $message)
                <div class="pristine-error text-primary-3 mt-2">
                    {{ $message }}
                </div>
            @endforeach
        @endif
    </div>
</div>
