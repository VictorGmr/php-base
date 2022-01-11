@section('breadcrumbs')
    @if($attributes->has('model') && $attributes->get('model'))
        {{ Breadcrumbs::render($attributes->get('action'), $attributes->get('model')) }}
    @else
        {{ Breadcrumbs::render($attributes->get('action')) }}
    @endif
@endsection

@section('page_title')
    @if($attributes->has('label'))
        {{$attributes->get('label')}}
    @else
        {{__(ModuleConfig::getPageTitle($attributes->get('action')).' '.ModuleConfig::getLabel($number))}}
    @endif
@endsection
