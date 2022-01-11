<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Login extends Component
{
    public $login;
    public $password;

    public function render()
    {
        return view('livewire.login');
    }

    public function logar()
    {
        $validated = $this->validate(['login' => 'required']);
        dd($validated);
    }
}
