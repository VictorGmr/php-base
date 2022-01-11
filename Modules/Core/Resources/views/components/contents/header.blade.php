@section('subhead')
    @if($attributes->has('label'))
        <title>{{__(config('systemconfig.app_name')).' - '.$attributes->get('label')}}</title>
    @else
        <title>{{__(config('systemconfig.app_name').' - '.ModuleConfig::getPageTitle($attributes->get('action')).' '.ModuleConfig::getLabel($number))}}</title>
    @endif
@endsection

@section('breadcrumbs')
    @if($attributes->has('model') && $attributes->get('model'))
        {{ Breadcrumbs::render($attributes->get('action'), $attributes->get('model')) }}
    @else
        {{ Breadcrumbs::render($attributes->get('action')) }}
    @endif
@endsection

<x-contents.title>
    @if($attributes->has('label'))
        {{$attributes->get('label')}}
    @else
        {{__(ModuleConfig::getPageTitle($attributes->get('action')).' '.ModuleConfig::getLabel($number))}}
    @endif
</x-contents.title>
