<?php

namespace Modules\SystemConfig\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Application\Entities\Application;
use Modules\Company\Entities\Company;

class TopBarLivewire extends Component
{
    public $applications;

    public function mount()
    {
        //$company = Company::where('alias','admin')->get()->first();
        //$application = Application::where('alias','admin')->get()->first();
        //$company->applications()->saveMany([$application]);
       // dd("Fim");
        $user = Auth::user();
        //dd($user->applications, $user->applications[0]->pivot->id);
        $this->applications = $user->applications;
    }

    public function render()
    {
        return view('midone.layout.components.top-bar');
    }

    public function setApplication(Application $application)
    {
        session(['current-app' => $application]);
        return redirect()->route('dashboard');
    }
}
