<a class="flex items-center @if($attributes->has('mt')) mt-{{$attributes->get('mt')}} @endif "
   :class="currentTab == '{{$attributes->get('target')}}' ? 'text-theme-1 dark:text-theme-10 font-medium' : ''"
   href="#{{$attributes->get('target')}}"
   @click.prevent="currentTab = '{{$attributes->get('target')}}'"
>
    @if($attributes->has('ico')) <i data-feather="{{$attributes->get('ico')}}" class="w-4 h-4 mr-2"></i> @endif {{$attributes->get('label')}}
</a>
