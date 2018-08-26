<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;

class SingletonUser implements Authenticatable
{
    private static $user = null;

    public function getAuthIdentifierName() {
        return "auth_id";
    }

    public function getAuthIdentifier() {
        return "singleton";
    }

    public function getAuthPassword() {
        return config('app.password_hash');
    }

    public function getRememberToken() {}

    public function setRememberToken($value) {}

    public function getRememberTokenName() {}

    public static function getUser() {
        if (is_null(static::$user)) {
            static::$user = new static();
        }
        return static::$user;
    }

}
