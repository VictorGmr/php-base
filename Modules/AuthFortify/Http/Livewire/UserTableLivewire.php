<?php

namespace Modules\AuthFortify\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Modules\AuthFortify\Entities\User;
use Modules\AuthFortify\Enum\DomainsUserEnum;
use Modules\AuthFortify\Services\UserService;
use Modules\Core\Helpers\Application\ModuleConfig;
use Modules\Core\Http\Livewire\DataTable\CoreDataTableComponent;
use Modules\Core\Http\Livewire\Traits\ConfirmModalTrait;
use Modules\Core\Http\Livewire\Traits\NotifyTrait;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class UserTableLivewire extends CoreDataTableComponent
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

    public function boot(UserService $service)
    {
        $this->service = $service;
        $this->queryString['columnSearch'] = ['except' => null];
        ModuleConfig::setModuleDomain(
            config('authfortify.alias'),
            DomainsUserEnum::USER
        );
    }

    public function rowView(): string
    {
        return 'authfortify::user.livewire.table';
    }

    /**
     * Actions
     */

    public function create()
    {
        return redirect()->route('user-create');
    }

    public function query(): Builder
    {
        return User::query()
            ->when($this->getFilter('active'), function ($query, $active) {
                if($active == 'active'){
                    return $query->whereActive(true);
                }
                return $query->whereActive(false);
            })->whereHas('companies', function ($join){
                $join->where('cmp_companies.id' , session()->get('default-company')->id);
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
            Column::make('E-mail','email')
                ->sortable()
                ->searchable(),
            Column::make('Status','active'),
            Column::make('','actions'),
        ];
    }
}
