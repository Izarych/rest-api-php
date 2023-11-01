<?php

namespace App\Guards;

use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

class HeaderGuard implements Guard
{

    use GuardHelpers;

    protected Request $request;

    public function __construct(UserProvider $provider, Request $request)
    {
        $this->provider = $provider;
        $this->request = $request;
    }

    public function user()
    {
        if ($this->user) {
            return $this->user;
        }

        $userId = $this->request->header('User-Id');

        if ($userId) {
            $this->user = $this->provider->retrieveById($userId);
        }

        return $this->user;
    }

    public function validate(array $credentials = [])
    {
        // TODO: Implement validate() method.
    }
}
