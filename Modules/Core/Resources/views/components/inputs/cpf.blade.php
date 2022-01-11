<div class="input-form mt-3"
     x-data="{ mask: [
         {
            mask: '000.000.000-00',
            lazy: false,
            placeholderChar: '_',
         }
     ]}"
     x-init="
        IMask($refs.{{$name}},
        { mask })
    "
>
    <div class="input-form {{$errors->has($name) ? 'has-error' : ''}}">
        <label for="validation-form-1" class="form-label w-full flex flex-col sm:flex-row">
            {{$label}}
            @isset($hint)
                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">
                    {{$hint}}
                </span>
            @endisset
        </label>
        <input {!! $attributes->merge(['class' => 'form-control imask-cpf']) !!} type="text" x-ref="{{$name}}">
        @if($errors->has($name))
            @foreach($errors->get($name) as $message)
                <div class="pristine-error text-primary-3 mt-2">
                    {{ $message }}
                </div>
            @endforeach
        @endif
    </div>
</div>
