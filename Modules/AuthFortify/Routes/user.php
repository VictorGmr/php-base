<?php

use Illuminate\Support\Facades\Route;
use Modules\AuthFortify\Http\Controllers\AuthFortifyController;
use Modules\AuthFortify\Http\Livewire;

Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {

    Route::get('/user-create', Livewire\UserLivewire::class)
        ->middleware(['auth:' . config('fortify.guard')])
        ->name('user-create');

    Route::get('/{uuid}/profile', Livewire\UserProfile::class)
        ->middleware(['auth:' . config('fortify.guard')])
        ->name('user-profile');

    Route::get('/user-list', Livewire\UserTableLivewire::class)
        ->middleware(['auth:' . config('fortify.guard')])
        ->name('user-list');
});
