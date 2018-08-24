<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class WebController extends Controller
{
    public function __invoke(Request $request) {
        $events = Event::whereRaw('`date` >= CURDATE()')->orderBy('date')->orderBy('time')->get();
        return view('welcome', compact('events'));
    }
}
