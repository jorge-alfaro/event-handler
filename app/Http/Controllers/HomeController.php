<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $greetings = "";

        /* This sets the $time variable to the current hour in the 24 hours clock format */
        $time = date("H");

        /* If the time is less than 1200 hours, show good morning */
        if ($time < "6") {
            $greetings = "Buenas madrugadas!";
        }
        if ($time >= "6" && $time < "12") {
            $greetings = "Buen dia!";
        } else

            /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
            if ($time >= "12" && $time < "17") {
                $greetings = "Buena tarde!";
            } else

                /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
                if ($time >= "17" && $time < "19") {
                    $greetings = "Buena tarde";
                } else

                    /* Finally, show good night if the time is greater than or equal to 1900 hours */
                    if ($time >= "19") {
                        $greetings = "Buena noche";
                    }
        // instances
        $activeEvent = Event::query()->where('status', true)->first();

        if (!is_null($activeEvent)) {
            $countMembers = Member::query()->where('event_id', $activeEvent->id)->count();
            $eventName = $activeEvent->name;
        } else {
            $eventName = 'No hay.';
        }
        $timeAgo = $activeEvent->created_at->diffForHumans();

        return view('home', compact('greetings', 'eventName', 'timeAgo', 'countMembers'));
    }
}
