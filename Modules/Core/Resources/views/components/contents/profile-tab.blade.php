<div class="intro-y box mt-5" x-show="currentTab == '{{ $attributes->get('name') }}'" x-cloak>
    <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
        <h2 class="font-medium text-base mr-auto">{{$title}}</h2>
    </div>
    <div class="p-5">
        {{$slot}}
    </div>
</div>
