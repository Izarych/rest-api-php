<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class UserProvider implements \Illuminate\Contracts\Auth\UserProvider
{
    public function retrieveById($identifier)
    {
        return User::find($identifier);
    }

    public function retrieveByToken($identifier, $token)
    {
        // TODO: Implement retrieveByToken() method.
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // TODO: Implement updateRememberToken() method.
    }

    public function retrieveByCredentials(array $credentials)
    {
        // TODO: Implement retrieveByCredentials() method.
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // TODO: Implement validateCredentials() method.
    }
}
