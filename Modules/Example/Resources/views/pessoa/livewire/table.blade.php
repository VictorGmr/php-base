<x-livewire-tables::table.cell>
    {{$row->name}}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <x-links.status :active="$row->active" wire:click.prevent="confirmChangeStatusItemModal('{{$row->name}}','{{$row->uuid}}','{{$row->active}}')"/>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="flex justify-center items-center">
        <a class="flex items-center mr-3" href="{{route('pessoa-edit',$row->uuid)}}" wire:loadind.attr="disabled">
            <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Editar
        </a>
        <a class="flex items-center text-theme-6 cursor-pointer" wire:click.prevent="confirmDeleteItemModal('{{$row->name}}','{{$row->uuid}}')" wire:loadind.attr="disabled">
            <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Deletar
        </a>
    </div>
</x-livewire-tables::table.cell>
