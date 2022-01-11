<?php

namespace Modules\Core\Http\Livewire\DataTable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Traits\ComponentHelpers;
use Rappasoft\LaravelLivewireTables\Traits\WithBulkActions;
use Rappasoft\LaravelLivewireTables\Traits\WithColumnSelect;
use Rappasoft\LaravelLivewireTables\Traits\WithCustomPagination;
use Rappasoft\LaravelLivewireTables\Traits\WithFilters;
use Rappasoft\LaravelLivewireTables\Traits\WithFooter;
use Rappasoft\LaravelLivewireTables\Traits\WithHeader;
use Rappasoft\LaravelLivewireTables\Traits\WithPerPagePagination;
use Rappasoft\LaravelLivewireTables\Traits\WithReordering;
use Rappasoft\LaravelLivewireTables\Traits\WithSearch;
use Rappasoft\LaravelLivewireTables\Traits\WithSorting;
use Rappasoft\LaravelLivewireTables\Utilities\ColumnUtilities;

/**
 * Class DataTableComponent
 *
 * @package Rappasoft\LaravelLivewireTables
 */
abstract class CoreDataTableComponent extends DataTableComponent
{
    use ComponentHelpers;
    use WithBulkActions;
    use WithColumnSelect;
    use WithCustomPagination;
    use WithFilters;
    use WithFooter;
    use WithHeader;
    use WithPerPagePagination;
    use WithReordering;
    use WithSearch;
    use WithSorting;

    protected $inputSearch = '';

    /**
     * Dump the filters array for debugging at the top of the datatable
     *
     * @var bool
     */
    public bool $dumpFilters = false;

    /**
     * The default pagination theme.
     *
     * @var string
     */
    public $paginationTheme = 'tailwind';

    /**
     * Whether or not to refresh the table at a certain interval
     * false is off
     * If it's an integer it will be treated as milliseconds (2000 = refresh every 2 seconds)
     * If it's a string it will call that function every 5 seconds unless it is 'keep-alive' or 'visible'.
     *
     * @var bool|string
     */
    public $refresh = false;

    /**
     * Whether or not to display an offline message when there is no connection.
     *
     * @var bool
     */
    public bool $offlineIndicator = true;

    /**
     * The message to show when there are no results from a search or query
     *
     * @var string
     */
    public string $emptyMessage = 'No items found. Try to broaden your search.';

    /**
     * Whether or not to display a responsive table
     *
     * @var bool
     */
    public bool $responsive = true;

    /**
     * Unique name to use for this table if you want the 'per page' options to be remembered on a per table basis.
     * If not, all 'per page' stored in the session will default to the same option for every table with this default name.
     *
     * I.e. If the users changes it to 25 on the users table, the roles table will also default to 25, unless they have unique tableName's
     *
     * @var string
     */
    protected string $tableName = 'table';

    /**
     * Name of the page parameter for pagination
     * Good to change the default if you have more than one datatable on a page.
     *
     * @var string
     */
    protected string $pageName = 'page';

    /**
     * @var \null[][]
     */
    protected $queryString = [
        'filters' => ['except' => null],
        'sorts' => ['except' => null],
    ];

    /**
     * @var string[]
     */
    protected $listeners = ['refreshDatatable' => '$refresh'];

    /**
     * The array defining the columns of the table.
     *
     * @return array
     */
    abstract public function columns(): array;

    /**
     * The base query with search and filters for the table.
     *
     * @return Builder|Relation
     */
    abstract public function query();

    /**
     * TableComponent constructor.
     *
     * @param null $id
     */
    public function __construct($id = null)
    {
        parent::__construct($id);

        $theme = config('livewire-tables.theme');

        if ($theme === 'bootstrap-4' || $theme === 'bootstrap-5') {
            $this->paginationTheme = 'bootstrap';
        }

        $this->inputSearch = config('livewire-tables.input-search');
        $this->filters = array_merge($this->filters, $this->baseFilters);
    }

    /**
     * Get the rows query builder with sorting applied.
     *
     * @return Builder|Relation
     */
    public function rowsQuery()
    {
        $this->cleanFilters();

        $query = $this->query();

        if (method_exists($this, 'applySorting')) {
            $query = $this->applySorting($query);
        }

        if (method_exists($this, 'applySearchFilter')) {
            $query = $this->applySearchFilter($query);
        }

        return $query;
    }

    /**
     * Get the rows paginated collection that will be returned to the view.
     *
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function getRowsProperty()
    {
        if ($this->paginationEnabled) {
            return $this->applyPagination($this->rowsQuery());
        }

        return $this->rowsQuery()->get();
    }

    /**
     * Reset all the criteria
     */
    public function resetAll(): void
    {
        $this->resetFilters();
        $this->resetSearch();
        $this->resetSorts();
        $this->resetBulk();
        $this->resetPage();
    }

    /**
     * The view to render each row of the table.
     *
     * @return string
     */
    public function rowView(): string
    {
        return 'livewire-tables::'.config('livewire-tables.theme').'.components.table.row-columns';
    }

    /**
     * The view to add any modals for the table, could also be used for any non-visible html
     *
     * @return string
     */
    public function modalsView(): string
    {
        return 'livewire-tables::stubs.modals';
    }

    /**
     * @return mixed
     */
    public function render()
    {
        return view('livewire-tables::'.config('livewire-tables.theme').'.datatable')
            ->with([
                'columns' => $this->columns(),
                'rowView' => $this->rowView(),
                'filtersView' => $this->filtersView(),
                'customFilters' => $this->filters(),
                'rows' => $this->rows,
                'modalsView' => $this->modalsView(),
                'bulkActions' => $this->bulkActions,
            ]);
    }

    /**
     * Override
     */
    public function applySearchFilter($query)
    {
        $searchableColumns = $this->getSearchableColumns();

        if ($this->hasFilter('search') && count($searchableColumns)) {
            $search = $this->getFilter('search');

            // Group search conditions together
            $query->where(function (Builder $subQuery) use ($search, $query, $searchableColumns) {
                foreach ($searchableColumns as $column) {
                    // Does this column have an alias or relation?
                    $hasRelation = ColumnUtilities::hasRelation($column->column());

                    // Let's try to map this column to a selected column
                    $selectedColumn = ColumnUtilities::mapToSelected($column->column(), $query);

                    // If the column has a search callback, just use that
                    if ($column->hasSearchCallback()) {
                        // Call the callback
                        ($column->getSearchCallback())($subQuery, $search);
                    } elseif (! $hasRelation || $selectedColumn) { // If the column isn't a relation or if it was previously selected
                        $whereColumn = $selectedColumn ?? $column->column();

                        // TODO: Skip Aggregates
                        if (! $hasRelation) {
                            $whereColumn = Schema::hasColumn($query->getModel()->getTable(), $whereColumn) ? $query->getModel()->getTable() . '.' . $whereColumn : $whereColumn;
                        }

                        // We can use a simple where clause
                        $subQuery->orWhere($whereColumn, 'ilike', '%' . $search . '%');
                    } else {
                        // Parse the column
                        $relationName = ColumnUtilities::parseRelation($column->column());
                        $fieldName = ColumnUtilities::parseField($column->column());

                        // We use whereHas which can work with unselected relations
                        $subQuery->orWhereHas($relationName, function (Builder $hasQuery) use ($fieldName, $search) {
                            $hasQuery->where($fieldName, 'ilike', '%' . $search . '%');
                        });
                    }
                }
            });
        }

        return $query;
    }

    public function getCheckedsItens()
    {
        if(count($this->selectedKeys)){
            $query = $this->rowsQuery();
            $query->whereIn('id',$this->selectedKeys);
            return $query->get();
        }
        return [];
    }
}
