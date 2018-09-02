<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\AuthenticationException;

use App\Event;
use App\Mail\EventCreated as EventCreatedMail;

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

        $data = static::prepareValidator($request->all())->validate();
        $event = Event::create($data);

        if ($request->wantsJson()) {
            return $event;
        }

        $url = route('event', ['event' => $event, 'token' => $event->raw_token]);
        $email = new EventCreatedMail($url);

        Mail::to($event->contact_email)->send($email);

        return redirect()->route('event', ['event' => $event, 'token' => $event->raw_token]);
    }

    public static function update(Request $request, Event $event) {

	    if (!Hash::check(request('token'), $event->edit_token)) {
	        throw new AuthenticationException();
	    }

        $data = static::prepareValidator($request->all())->validate();
        $event->fill($data)->save();

        if ($request->wantsJson()) {
            return $event;
        }
        return redirect()->back();
    }

    private static function prepareValidator($data) {
		$validator = Validator::make($data, static::VALIDATION_RULES);

		$validator->sometimes('registration_email', 'nullable|email|required_without_all:registration_tel,registration_url', function($input) {
			return boolval($input->registration_required);
		});

		$validator->sometimes('registration_tel', 'nullable|required_without_all:registration_email,registration_url', function($input) {
			return boolval($input->registration_required);
		});

		$validator->sometimes('registration_url', 'nullable|url|required_without_all:registration_email,registration_tel', function($input) {
			return boolval($input->registration_required);
		});

		return $validator;
    }
}
