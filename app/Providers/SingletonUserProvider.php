<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

use App\SingletonUser;

/**
 * Class SingletonUserProvider
 * @package App\Providers
 */
class SingletonUserProvider extends ServiceProvider implements UserProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

	/**
	 * @param $identifier
	 * @return SingletonUser|null
	 */
	public function retrieveById($identifier): ?SingletonUser {
        $user = SingletonUser::getUser();
        if ($identifier == $user->getAuthIdentifier()) {
            return $user;
        }
        return null;
    }

	/**
	 * @param mixed $identifier
	 * @param string $token
	 * @return SingletonUser|null
	 */
	public function retrieveByToken($identifier, $token): ?SingletonUser {
		return null;
    }

	/**
	 * @param Authenticatable $user
	 * @param string $token
	 */
	public function updateRememberToken(Authenticatable $user, $token): void
	{}

	/**
	 * @param array $credentials
	 * @return SingletonUserProvider|null
	 */
	public function retrieveByCredentials(array $credentials): ?SingletonUser {
        return SingletonUser::getUser();
    }

	/**
	 * @param Authenticatable $user
	 * @param array $credentials
	 * @return bool
	 */
	public function validateCredentials(Authenticatable $user, array $credentials): bool {
        if (!array_key_exists('password', $credentials)) {
            return false;
        }
        return Hash::check($credentials['password'], $user->getAuthPassword());
    }
}
