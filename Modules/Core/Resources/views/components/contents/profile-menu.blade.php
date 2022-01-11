<!-- BEGIN: Profile Menu -->
<div class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse">
    <div class="intro-y box mt-5">
        {{$profileInfo ?? ""}}

        <div class="p-5 border-t border-gray-200 dark:border-dark-5">
            {{$slot}}
        </div>

        <div class="p-5 border-t border-gray-200 dark:border-dark-5 flex">
            {{$profileButton ?? ""}}
        </div>
    </div>
</div>
<!-- END: Profile Menu -->
