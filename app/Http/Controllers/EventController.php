<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    public static function create(Request $request) {

        $data = $request->validate([
            'date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'title' => 'required',
            'contact_email' => 'required|email',
            'description' => 'required',
        ]);

        $event = new Event($data);
        $event->save();

        if ($request->wantsJson()) {
            return $event;
        }

        return redirect()->route('home');
    }

    public static function update(Request $request, Event $event) {
        return "";
    }
}
