<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class SingletonUser
 * @package App
 */
class SingletonUser implements Authenticatable
{
	/**
	 * @var null
	 */
	private static $user = null;

	/**
	 * @return string
	 */
	public function getAuthIdentifierName() {
        return "auth_id";
    }

	/**
	 * @return mixed|string
	 */
	public function getAuthIdentifier() {
        return "singleton";
    }

	/**
	 * @return \Illuminate\Config\Repository|mixed|string
	 */
	public function getAuthPassword() {
        return config('app.password_hash');
    }

	/**
	 * @return string|void
	 */
	public function getRememberToken() {}

	/**
	 * @param string $value
	 */
	public function setRememberToken($value) {}

	/**
	 * @return string|void
	 */
	public function getRememberTokenName() {}

	/**
	 * @return static
	 */
	public static function getUser() {
        if (is_null(static::$user)) {
            static::$user = new static();
        }
        return static::$user;
    }

}
