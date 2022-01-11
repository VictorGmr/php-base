<div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Invoice</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Invoice</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        <section class="content">
            <div class="invoice p-3 mb-3">
                <div
                    @if (is_numeric($refresh))
                    wire:poll.{{ $refresh }}ms
                    @elseif(is_string($refresh))
                    @if ($refresh === '.keep-alive' || $refresh === 'keep-alive')
                    wire:poll.keep-alive
                    @elseif($refresh === '.visible' || $refresh === 'visible')
                    wire:poll.visible
                    @else
                    wire:poll="{{ $refresh }}"
                    @endif
                    @endif
                    class="container-fluid p-0"
                >
                    @include('livewire-tables::includes.debug')
                    @include('livewire-tables::bootstrap-4.includes.offline')
                    @include('livewire-tables::bootstrap-4.includes.sorting-pills')
                    @include('livewire-tables::bootstrap-4.includes.filter-pills')

                    <div class="d-md-flex justify-content-between mb-3">
                        <div class="d-md-flex">
                            @include('livewire-tables::bootstrap-4.includes.reorder')
                            @include('livewire-tables::bootstrap-4.includes.search')

                            @if ($filtersEnabled && $showFilterDropdown)
                                <div class="{{ $showSearch ? 'ml-0 ml-md-2' : '' }} mb-3 mb-md-0">
                                    @include('livewire-tables::bootstrap-4.includes.filters')
                                </div>
                            @endif
                        </div>

                        <div class="d-md-flex">
                            <div>@include('livewire-tables::bootstrap-4.includes.bulk-actions')</div>
                            <div>@include('livewire-tables::bootstrap-4.includes.column-select')</div>
                            <div>@include('livewire-tables::bootstrap-4.includes.per-page')</div>
                        </div>
                    </div>

                    @include('livewire-tables::bootstrap-4.includes.table')
                    @include('livewire-tables::bootstrap-4.includes.pagination')
                </div>

                @isset($modalsView)
                    @include($modalsView)
                @endisset
            </div>
        </section>
</div>
