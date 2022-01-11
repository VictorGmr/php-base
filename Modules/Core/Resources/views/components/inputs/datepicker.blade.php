<div class="input-form @if($cols) col-span-12 lg:col-span-{{$cols}} @endif mt-{{$mt}}">
    <div class="input-form {{$errors->has($name) ? 'has-error' : ''}}">
        <label for="{{$attributes->get('id')}}" class="form-label w-full flex flex-col sm:flex-row">
            {{$label}}
            @isset($hint)
                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">
                    {{$hint}}
                </span>
            @endisset
        </label>
        <input {!! $attributes->merge(['class' => 'datepicker form-control']) !!} data-single-mode="true" data-format="DD/MM/YYYY">
        @if($errors->has($name))
            @foreach($errors->get($name) as $message)
                <div class="pristine-error text-primary-3 mt-2">
                    {{ $message }}
                </div>
            @endforeach
        @endif
    </div>
</div>
