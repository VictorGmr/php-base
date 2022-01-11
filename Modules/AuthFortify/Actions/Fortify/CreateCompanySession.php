<?php

namespace Modules\AuthFortify\Actions\Fortify;

use Illuminate\Support\Facades\Auth;

class CreateCompanySession
{
    public function handle()
    {
        $user = Auth::user();
        $defaultCompany = $user->companies->first();
        session(['default-company' => $defaultCompany]);
    }
}
