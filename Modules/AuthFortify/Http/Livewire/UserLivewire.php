<?php

namespace Modules\AuthFortify\Http\Livewire;

use Laravel\Fortify\Contracts\CreatesNewUsers;
use Modules\AuthFortify\Enum\DomainsUserEnum;
use Modules\Core\Abstratcs\Livewire\BaseLivewire;
use Modules\Core\Helpers\Application\ModuleConfig;
use Modules\Core\Http\Livewire\Traits\NotifyTrait;
use Route;

class UserLivewire extends BaseLivewire
{
    use NotifyTrait;

    public $user;

    /**
     * Property
     */
    public $active = true;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public $status;

    public function boot()
    {
        $this->action = Route::getFacadeRoot()->current()->action['as'];
        ModuleConfig::setModuleDomain(
            config('authfortify.alias'),
            DomainsUserEnum::USER
        );
    }

    public function mount($user = null)
    {
        if($user){ $this->fill($user); $this->user = $user;}
    }

    public function render()
    {
        return view('authfortify::user.livewire.user');
    }

    public function saveUser(CreatesNewUsers $createsNewUsers)
    {
        $company = session()->get('default-company');
        if(empty($company)){
            $this->flashFailed('Não foi possível cadastrar o usuário!');
            return redirect()->route('user-list');
        }

        $user = $createsNewUsers->create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ]);

        $company->users()->saveMany([$user]);
        $this->flashSuccess('Usuário cadastrando com sucesso.');
        return redirect()->route('user-list');
    }
}
