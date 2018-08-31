<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\AuthenticationException;
use App\Event;

class EventController extends Controller
{
	private const VALIDATION_RULES = [
        'date' => 'required|date_format:Y-m-d|after_or_equal:today',
        'title' => 'required',
        'contact_email' => 'required|email',
        'description' => 'required',
		"time" => "nullable|date_format:H:i",
		"location" => "nullable",
		"costs" => "nullable",
		"registration_required" => "nullable|boolean",
		"registration_email" => "nullable|email",
		"registration_tel" => "nullable",
		"registration_url" => "nullable|url",
		"contact_name" => "nullable",
		"contact_tel" => "nullable",
    ];
	
    public static function store(Request $request) {

        $data = $request->validate(static::VALIDATION_RULES);
        $event = Event::create($data);

        if ($request->wantsJson()) {
            return $event;
        }
        return redirect()->route('event', ['event' => $event, 'token' => $event->raw_token]);
    }

    public static function update(Request $request, Event $event) {
	    
	    if (!Hash::check(request('token'), $event->edit_token)) {
	        throw new AuthenticationException();
	    }
	    
        $data = $request->validate(static::VALIDATION_RULES);
        $event->fill($data)->save();
        
        if ($request->wantsJson()) {
            return $event;
        }
        return redirect()->back();
    }
}
