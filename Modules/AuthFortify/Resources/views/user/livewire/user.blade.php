<div>
    <!-- BEGIN: Header -->
    <x-contents.page-header :action="$action" :model="$user"/>
    <!-- END: Header -->

    <x-contents.grid>
        <x-contents.painel cols="6">

            <!--BEGIN: Form-->
            <x-inputs.switch label="Status" wire:model.defer="active"/>
            <x-inputs.text label="Nome" placeholder="Seu nome" wire:model.defer="name"/>
            <x-inputs.text label="Email" placeholder="exemple@gmail.com" wire:model.defer="email"/>
            <x-inputs.password label="Senha" placeholder="Senha" wire:model.defer="password"/>
            <x-inputs.password label="Confirmar Senha" placeholder="Confirmar Senha" wire:model.defer="password_confirmation"/>
            <!--END: Form-->

            <!--BEGIN: Buttons-->
            <div class="lg:col-span-6 text-right">
                <x-buttons.action label="Cancelar" type="secondary" :route="route('user-list')"/>
                <x-buttons.action label="Salvar" loading-label="Salvando" wire:click="saveUser"/>
            </div>
            <!--END: Buttons-->

        </x-contents.painel>
    </x-contents.grid>
</div>
