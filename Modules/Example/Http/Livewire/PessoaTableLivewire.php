<?php

namespace Modules\Example\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Http\Livewire\DataTable\CoreDataTableComponent;
use Modules\Core\Http\Livewire\Traits\ConfirmModalTrait;
use Modules\Core\Http\Livewire\Traits\NotifyTrait;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Modules\Example\Enum\DomainsExampleEnum;
use Modules\Core\Helpers\Application\ModuleConfig;
use Modules\Example\Entities\Pessoa;
use Modules\Example\Services\Contracts\PessoaServiceInterface;

class PessoaTableLivewire extends CoreDataTableComponent
{
    use NotifyTrait;
    use ConfirmModalTrait;

    protected $service;
    public int $totalItensKeys = 0;

    public string $defaultSortColumn = 'id';
    public string $defaultSortDirection = 'desc';

    public array $bulkActions = [
        'create'   => 'Adicionar Novo',
        'confirmDeleteAllItensModal'   => 'Deletar',
        'confirmChangeStatusAllItensModal' => 'Mudar Status',
    ];

    public $columnSearch = [
        'city' => null,
        'state' => null,
    ];

    public function boot(PessoaServiceInterface $service)
    {
        ModuleConfig::setModuleDomain(
            config('example.alias'),
            DomainsExampleEnum::PESSOA
        );

        $this->service = $service;
        $this->queryString['columnSearch'] = ['except' => null];
    }

    public function rowView(): string
    {
        return 'example::pessoa.livewire.table';
    }

    /**
     * Actions
     */

    public function create()
    {
        return redirect()->route('pessoa-create');
    }

    public function query(): Builder
    {
        return Pessoa::query()
            ->when($this->getFilter('active'), function ($query, $active) {
                if($active == 'active'){
                    return $query->whereActive(true);
                }
                return $query->whereActive(false);
            });
    }

    public function filters(): array
    {
        return [
            'active' => Filter::make('Status')
                ->select([
                    ''    => 'Todos',
                    'active' => 'Ativo',
                    'inactive'  => 'Inativo',
                ]),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make('Nome','name')
                ->sortable()
                ->searchable(),
            Column::make('Status','active'),
            Column::make('','actions'),
        ];
    }
}
