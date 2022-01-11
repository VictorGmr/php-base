<div class="flex {{ $active ? 'text-theme-9' : 'text-theme-6' }}">
    <a class="flex items-center mr-3 cursor-pointer" wire:loadind.attr="disabled" {{$attributes->wire('click')}}>
        <i data-feather="check-square" class="w-4 h-4 mr-2"></i> {{ $active ? 'Ativado' : 'Desativado' }}
    </a>
</div>
