<div>
    <!-- BEGIN: Header -->
    <x-contents.page-header :action="$action" :model="$pessoa"/>
    <!-- END: Header -->

    <x-contents.grid>
        <x-contents.painel cols="6">

            <x-contents.response/>
            <!--BEGIN: Form-->
                <x-inputs.switch label="Status" wire:model.defer="active"/>
                <x-inputs.text label="Nome" placeholder="Nome" wire:model.defer="name" required/>
            <!--END: Form-->

            <!--BEGIN: Buttons-->
            <div class="lg:col-span-6 text-right">
                <x-buttons.action label="Cancelar" type="secondary" :route="route('pessoa-list')"/>
                <x-buttons.action label="Salvar" loading-label="Salvando" wire:click="save"/>
            </div>
            <!--END: Buttons-->

        </x-contents.painel>
    </x-contents.grid>
</div>
