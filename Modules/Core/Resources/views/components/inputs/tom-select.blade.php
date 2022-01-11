<div class="input-form mt-3">
    <label class="form-label w-full flex flex-col sm:flex-row">{{$label}}
        @isset($hint)
            <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">
                    {{$hint}}
                </span>
        @endisset
    </label>
    <div class="mt-2">
        <select
            data-placeholder="Buscar"
            class='tom-select w-full'
            {{ $attributes->wire('model') }}
            @if($multiple) multiple @endif
        >
            <option value="Selecione">Selecione...</option>
            @foreach($options as $key => $option)
                <option value="{{$option['key']}}">{{$option['label']}}</option>
            @endforeach
        </select>
        @if($errors->has($name))
            @foreach($errors->get($name) as $message)
                <div class="pristine-error text-primary-3 mt-2">
                    {{ $message }}
                </div>
            @endforeach
        @endif
    </div>
</div>
