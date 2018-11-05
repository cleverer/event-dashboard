<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Event;
use App\SingletonUser;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class WebController
 * @package App\Http\Controllers
 */
class WebController extends Controller
{
	/**
	 * @param Request $request
	 * @param Event|null $event
	 * @throws NotFoundHttpException
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public static function home(Request $request, Event $event = null) {
        $events = Event::whereRaw('`date` >= CURDATE()')->orderBy('date')->orderBy('time')->get();

        $data = [
            'events' => $events,
        ];

        if (!is_null($event)) {
            if (Hash::check(request('token'), $event->edit_token)) {
                if (!Auth::check()) {
                    Auth::login(SingletonUser::getUser());
                }
                $data['event'] = $event;
            } else {
                abort(404);
            }
        }

        return view('welcome', $data);
    }

	/**
	 * @param Request $request
	 * @param Event $event
	 * @return Event|\Illuminate\Http\RedirectResponse
	 * @throws \Illuminate\Auth\AuthenticationException
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public static function modifyEvent(Request $request, Event $event) {
        if ($request->submit == 'delete') {
            return EventController::remove($request, $event);
        } else {
            return EventController::update($request, $event);
        }
    }

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public static function login(Request $request) {
	    return redirect()->route('home');
    }
}
