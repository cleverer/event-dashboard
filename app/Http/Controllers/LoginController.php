<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    private static function respond(int $status) {
        return response()->json([
            'status' => $status,
        ], $status);
    }

    public static function check(Request $request) {
        if (Auth::guard('api')->check()) {
            return static::respond(200);
        }
        return static::respond(401);
    }

    public static function login(Request $request) {
        $credentials = $request->only('password');
        $guard = Auth::guard('api');
        if ($guard->check() || $guard->attempt($credentials)) {
            return static::respond(200);
        }
        return static::respond(401);
    }
}
