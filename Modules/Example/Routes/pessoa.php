<?php

use Modules\Example\Http\Livewire;

Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {

    Route::get('/list', Livewire\PessoaTableLivewire::class)
        ->middleware(['auth:' . config('fortify.guard')])
        ->name('pessoa-list');

    Route::get('/create', Livewire\PessoaLivewire::class)
        ->middleware(['auth:' . config('fortify.guard')])
        ->name('pessoa-create');

    Route::get('/{uuid}/edit', Livewire\PessoaLivewire::class)
        ->middleware(['auth:' . config('fortify.guard')])
        ->name('pessoa-edit');
});
