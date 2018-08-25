<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public static function check(Request $request) {
        return response()->json([
            'status' => 200,
        ]);
    }

    public static function login(Request $request) {
        $credentials = $request->only('password');
        $status = 401;
        if (Auth::attempt($credentials)) {
            $status = 200;
        }
        return response()->json([
            'status' => $status,
        ], $status);
    }
}
