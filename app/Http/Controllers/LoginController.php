<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\JsonResponse;

/**
 * Class LoginController
 * @package App\Http\Controllers
 */
class LoginController extends Controller
{

	/**
	 * @param int $status
	 * @return JsonResponse
	 */
	private static function respond(int $status): JsonResponse {
        return response()->json([
            'status' => $status,
        ], $status);
    }

	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public static function check(Request $request): JsonResponse {
        if (Auth::guard()->check()) {
            return static::respond(200);
        }
        return static::respond(401);
    }

	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public static function login(Request $request): JsonResponse {
        $credentials = $request->only('password');
        $guard = Auth::guard();
        if ($guard->check() || $guard->attempt($credentials)) {
            return static::respond(200);
        }
        return static::respond(401);
    }
}
