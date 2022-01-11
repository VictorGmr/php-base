<?php

namespace Modules\AuthFortify\Http\Livewire;

use Modules\Application\Entities\Application;
use Modules\Application\Entities\Module;
use Modules\Core\Abstratcs\Livewire\BaseLivewire;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DashboardLivewire extends BaseLivewire
{
    //public $company;

    public function mount()
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();
        Role::create([
            'name' => 'admin',
        ]);

        Permission::create([
            'name' => 'product-create',
            'guard_name' => session()->get('current-app')->alias,
        ]);

        dd("fim");
        //$application = Application::find(1);
        //$modules = Module::whereIn('alias',['user','company','application','module'])->get();
        //$application->modules()->sync($modules->pluck('id')->toArray());
        //dd($modules->pluck('id')->toArray());
        //$this->company = session()->get('default-company');
    }

    public function render()
    {
        return view('authfortify::auth.livewire.dashboard');
    }
}
