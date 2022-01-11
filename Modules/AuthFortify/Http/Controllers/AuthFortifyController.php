<?php

namespace Modules\AuthFortify\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\AuthFortify\Entities\User;

class AuthFortifyController extends Controller
{
    public function index()
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        return redirect()->route('dashboard');
    }
}
