<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

use App\SingletonUser;

class SingletonUserProvider extends ServiceProvider implements UserProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function retrieveById($identifier) {
        $user = SingletonUser::getUser();
        if ($identifier == $user->getAuthIdentifier()) {
            return $user;
        }
    }

    public function retrieveByToken($identifier, $token) {
    }

    public function updateRememberToken(Authenticatable $user, $token) {}

    public function retrieveByCredentials(array $credentials) {
        return SingletonUser::getUser();
    }

    public function validateCredentials(Authenticatable $user, array $credentials) {
        if (!array_key_exists('password', $credentials)) {
            return false;
        }
        return Hash::check($credentials['password'], $user->getAuthPassword());
    }
}
