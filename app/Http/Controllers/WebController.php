<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Event;
use App\SingletonUser;

class WebController extends Controller
{
    public static function home(Request $request, Event $event = null) {
        $events = Event::whereRaw('`date` >= CURDATE()')->orderBy('date')->orderBy('time')->get();

        $data = [
            'events' => $events,
        ];

        if (!is_null($event) && Hash::check(request('token'), $event->edit_token)) {
            if (!Auth::check()) {
                Auth::login(SingletonUser::getUser());
            }
            $data['event'] = $event;
        }

        return view('welcome', $data);
    }

    public static function modifyEvent(Request $request, Event $event) {
        if ($request->submit == 'delete') {
            return EventController::remove($request, $event);
        } else {
            return EventController::update($request, $event);
        }
    }

    public static function login(Request $request) {
	    return redirect()->route('home');
    }
}
