<?php

namespace Modules\AuthFortify\Http\Livewire;

use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Modules\Application\Services\Contracts\ApplicationServiceInterface;
use Modules\AuthFortify\Enum\DomainsUserEnum;
use Modules\AuthFortify\Services\UserService;
use Modules\Core\Helpers\Application\ModuleConfig;
use Modules\Core\Http\Livewire\Traits\NotifyTrait;
use Modules\Core\Abstratcs\Livewire\BaseLivewire;
use Route;

class UserProfile extends BaseLivewire
{
    use NotifyTrait;

    protected $service;
    protected $applicationService;

    public $user;

    /**
     * Property
     */
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $current_password;

    public $active_app = [];

    public function boot(
        UserService $service,
        ApplicationServiceInterface $applicationService
    ){
        $this->service = $service;
        $this->applicationService = $applicationService;

        $this->action = Route::getFacadeRoot()->current()->action['as'];
        ModuleConfig::setModuleDomain(
            config('authfortify.alias'),
            DomainsUserEnum::USER
        );
    }

    public function mount($uuid = null)
    {
        try{
            if($uuid) {
                $user = $this->service->findByUuid($uuid);
                $this->user = $user;
                $this->modelId = $user->id;
                $this->fill($user);
                foreach ($user->applications as $application){
                    $this->active_app[$application->alias] = true;
                }
            }
        }catch (\Exception $exception){
            $this->flashFailed($this->getExceptionMessage($exception));
            return redirect()->to(url()->previous());
        }
        //$this->active_app['admin'] = true;
    }

    public function render()
    {
        return view('authfortify::user.livewire.user-profile');
    }

    public function updateInformationPersonnel(UpdatesUserProfileInformation $updatesUserProfileInformation)
    {
        $updatesUserProfileInformation->update($this->user, [
            'name' => $this->name,
            'email' => $this->email,
        ]);
        $this->resetErrorBag();
        $this->notifySuccess("Informações pessoais atualizadas com sucesso!!");
    }

    public function updatePassword(UpdatesUserPasswords $updatesUserPasswords)
    {
        $updatesUserPasswords->update($this->user, [
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'current_password' => $this->current_password,
        ]);
        $this->resetErrorBag();
        $this->notifySuccess("Senha atualizada com sucesso!!");
    }

    public function setApplication()
    {
        $validated = $this->validate([
            'active_app.*' => 'nullable'
        ]);

        if(!isset($validated['active_app'])){
            return;
        }

        try{
            $this->applicationService->setApplicationForUser($validated['active_app']);
        }catch (\Exception $exception){
            $this->notifyFailed($this->getExceptionMessage($exception));
            return;
        }

        $this->notifySuccess("Usuário atualizado com sucesso!!");
    }
}
