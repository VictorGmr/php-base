<div
    x-data="{show: @entangle($attributes->wire('model'))}"
    @keydown.escape.window="show = 'close'"
    @confirm-delete-all-itens.window="if(show == 'close') show = 'open';"
    @hidden-confirm-delete-all-itens.window="if(show == 'open') show = 'close'"
    @click.self="show = 'close'"
    class="modal overflow-y-auto"
    :class="show == 'open' ? 'show' : ''"
    tabindex="-1"
    aria-hidden="false"
    style="margin-top: 0px; margin-left: 0px; padding-left: 0px; z-index: 10000;"
    x-cloak
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle w-16 h-16 text-theme-6 mx-auto mt-3"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                    <div class="text-3xl mt-5">Tem certeza?</div>
                    <div class="text-gray-600 mt-2">Você realmente deseja deletar <b>{{$countItens}}</b> registro(s)?</div>
                </div>
                <div class="px-5 pb-8 text-center">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1" @click="show = 'close'" wire:loading.attr="disabled">Cancelar</button>
                    <x-buttons.action label="Deletar" loading-label="Deletando" wire:click="deleteAllItem" type="danger"/>
                </div>
            </div>
        </div>
    </div>
</div>
