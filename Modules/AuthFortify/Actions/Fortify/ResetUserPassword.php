<?php

namespace Modules\AuthFortify\Actions\Fortify;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;
use Modules\AuthFortify\Rules\UserRule;

class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function reset($user, array $input)
    {
        Validator::make($input, [
            'password' => $this->passwordRules(),
        ],
            UserRule::getMessages(),
            UserRule::getAttributes()
        )->validate();

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
