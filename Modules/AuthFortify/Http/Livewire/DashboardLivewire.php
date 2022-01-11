<?php

namespace Modules\AuthFortify\Http\Livewire;

use Modules\Application\Entities\Application;
use Modules\Application\Entities\Module;
use Modules\Core\Abstratcs\Livewire\BaseLivewire;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DashboardLivewire extends BaseLivewire
{
    public function mount()
    {

    }

    public function render()
    {
        return view('authfortify::auth.livewire.dashboard');
    }
}
