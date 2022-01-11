<div class="relative flex items-center p-5">
    <div class="w-12 h-12 image-fit">
        @if(!$attributes->has('image'))
            <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="{{ asset('dist/images/profile-7.jpg') }}">
        @endif
    </div>
    <div class="ml-4 mr-auto">
        <div class="font-medium text-base">{{ $attributes->get('name') }}</div>
        <div class="text-gray-600">{{ $attributes->get('alias') }}</div>
    </div>
</div>
