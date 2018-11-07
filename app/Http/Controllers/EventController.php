<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
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

	/**
	 * @param Request $request
	 * @return Event|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\RedirectResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public static function store(Request $request) {

        $data = static::prepareValidator($request->all())->validate();
        $event = Event::create($data);

        if ($request->wantsJson()) {
            return $event;
        }

        $url = URL::signedRoute('event', ['event' => $event]);
        $email = new EventCreatedMail($url);

        Mail::to($event->contact_email)->queue($email);

        return redirect($url);
    }

	/**
	 * @param Request $request
	 * @param Event $event
	 * @return Event|\Illuminate\Http\RedirectResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public static function update(Request $request, Event $event) {
        $data = static::prepareValidator($request->all())->validate();
        $event->fill($data)->save();

        if ($request->wantsJson()) {
            return $event;
        }
        return redirect()->back();
    }

	/**
	 * @param Request $request
	 * @param Event $event
	 * @return Event|\Illuminate\Http\RedirectResponse
	 * @throws \Exception
	 */
	public static function remove(Request $request, Event $event) {
        $event->delete();

        if ($request->wantsJson()) {
            return $event;
        }
        return redirect()->route('home');
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
