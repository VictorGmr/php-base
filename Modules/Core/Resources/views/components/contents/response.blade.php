<div>
    @if($errors->has('request'))
        @foreach($errors->get('request') as $message)
            <div class="pristine-error text-primary-3 mt-2">
                {{ $message }}
            </div>
        @endforeach
    @endif
</div>

