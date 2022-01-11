<div class="intro-y col-span-12 lg:col-span-{{$cols}}">
    <div class="intro-y box">
        @isset($title)
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">{{$title}}</h2>
            </div>
        @endisset
        <div id="form-validation" class="p-5">
            <div class="preview">
                {{$slot}}
            </div>
        </div>
    </div>
</div>

