<?php

use Modules\SystemConfig\Http\Controllers\SystemConfigController;

Route::prefix('systemconfig')->group(function() {
    Route::get('/dark-mode-switcher', [SystemConfigController::class, 'switch'])->name("system-config.dark-mode-switcher");
});
