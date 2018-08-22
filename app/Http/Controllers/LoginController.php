<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public static function check(Request $request) {
        return [
            'status' => 200,
        ];
    }

    public static function login(Request $request) {
        return [
            'status' => 200,
        ];
    }
}
