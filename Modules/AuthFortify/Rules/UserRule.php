<?php

namespace Modules\AuthFortify\Rules;

use Modules\AuthFortify\Entities\User;

class UserRule
{
    public function __construct(User $user)
    {

    }

    public static function getAttributes()
    {
        return [
            'name' => 'Nome',
            'email' => 'Email',
            'password' => 'Senha',
            'current_password' => 'Senha Atual',
        ];
    }

    public static function getMessages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'password.confirmed' => 'O campo :attribute não confere.',
            'password.min' => 'A :attribute deve ter no mínimo 8 caracteres.',
            'unique' => 'O :attribute já foi usado.',
            'email' => 'O :attribute deve ser um endereço de email válido.',
        ];
    }
}
