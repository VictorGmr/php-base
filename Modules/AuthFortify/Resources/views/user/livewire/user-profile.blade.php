<div>
    <!-- BEGIN: Header -->
    <x-contents.page-header :action="$action" :model="$user"/>
    <!-- END: Header -->

    <x-contents.grid cols="12" gap="6" mt="0">

        <!-- BEGIN: PROFILE MENU -->
        <x-contents.profile-menu>
            <x-slot name="profileInfo">
                <x-contents.profile-info :name="$user->name" :alias="$user->email"/>
            </x-slot>
            <!-- BEGIN: Links -->
            <x-links.profile-link label="Informações pessoais" target="tab-01" ico="activity"/>
            <x-links.profile-link label="Mudar senha" target="tab-02" ico="lock" mt="5"/>
            @foreach(session()->get('default-company')->applications as $application)
                <x-links.profile-link :label="$application->name" :target="'tab-'.$application->alias" ico="lock" mt="5"/>
            @endforeach
            <!-- END: Links -->
            <x-slot name="profileButton">
                <a href="{{route('user-list')}}" type="button" class="btn btn-outline-secondary py-1 px-2 ml-auto">
                    Cancelar
                </a>
            </x-slot>
        </x-contents.profile-menu>
        <!-- END: PROFILE MENU -->

        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <!-- BEGIN: TAB -->
            <x-contents.profile-tab name="tab-01">
                <x-slot name="title">
                    Informações
                </x-slot>
                <!-- BEGIN: INPUTS -->
                <div class="flex flex-col-reverse xl:flex-row flex-col">
                    <div class="flex-1 mt-6 xl:mt-0">
                        <!--BEGIN: Form-->
                        <x-inputs.text label="Nome" placeholder="Seu nome" wire:model="name"/>
                        <x-inputs.text label="Email" placeholder="exemple@gmail.com" wire:model.defer="email"/>
                        <x-buttons.save label="Salvar" loading-label="Salvando" wire:click="updateInformationPersonnel"/>
                        <!--END: Form-->
                    </div>
                    <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                        <div class="border-2 border-dashed shadow-sm border-gray-200 dark:border-dark-5 rounded-md p-5">
                            <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                <img class="rounded-md" alt="Rubick Tailwind HTML Admin Template" src="{{ asset('dist/images/profile-7.jpg') }}">
                                <div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">
                                    <i data-feather="x" class="w-4 h-4"></i>
                                </div>
                            </div>
                            <div class="mx-auto cursor-pointer relative mt-5">
                                <button type="button" class="btn btn-primary w-full">Mudar Imagem</button>
                                <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: INPUTS -->
            </x-contents.profile-tab>
            <!-- END: TAB -->

            <!-- BEGIN: TAB -->
            <x-contents.profile-tab name="tab-02">
                <x-slot name="title">
                    Aplicações
                </x-slot>
                <!-- BEGIN: INPUTS -->
                <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 xl:col-span-12">
                        <!--BEGIN: Form-->
                        <x-inputs.password label="Senha Atual" placeholder="Sua senha atual" wire:model="current_password"/>
                        <x-inputs.password label="Nova Senha" placeholder="Nova Senha" wire:model="password"/>
                        <x-inputs.password label="Confirmar Nova Senha" placeholder="Confirmar Nova Senha" wire:model="password_confirmation"/>
                        <x-buttons.save label="Salvar" loading-label="Salvando" wire:click="updatePassword"/>
                        <!--END: Form-->
                    </div>
                </div>
                <!-- END: INPUTS -->
            </x-contents.profile-tab>
            <!-- END: TAB -->

            @foreach(session()->get('default-company')->applications as $index => $application)
                <!-- BEGIN: TAB -->
                    <x-contents.profile-tab :name="'tab-'.$application->alias">
                        <x-slot name="title">
                            {{$application->name}}
                        </x-slot>
                        <!-- BEGIN: INPUTS -->
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-12">
                                <!--BEGIN: Form-->
                                <x-inputs.switch wire:model="active_app.{{$application->alias}}"/>
                                <x-buttons.save label="Salvar" loading-label="Salvando" wire:click="setApplication"/>
                                <!--END: Form-->
                            </div>
                        </div>
                        <!-- END: INPUTS -->
                    </x-contents.profile-tab>
                    <!-- END: TAB -->
            @endforeach

        </div>

    </x-contents.grid>

</div>
