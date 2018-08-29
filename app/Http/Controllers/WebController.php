<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Event;

class WebController extends Controller
{
    public function __invoke(Request $request, Event $event = null) {
        $events = Event::whereRaw('`date` >= CURDATE()')->orderBy('date')->orderBy('time')->get();

        $data = [
            'events' => $events,
        ];

        if (!is_null($event) && Hash::check(request('token'), $event->edit_token)) {
            $data['event'] = $event;
        }

        return view('welcome', $data);
    }
}
