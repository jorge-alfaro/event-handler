<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return view('event.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
       $event = Event::create($request->all());
       return view('event.index');
    }

    public function changeStatus(Request $request)
    {
        $event = Event::findOrFail($request->event_id);
        if ($event->status){
            $event->status = false;
        }else {
            $event->status = true;
        }
        $event->update();

        return redirect('event/')->with('status', 'Evento actualizado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|void
     */
    public function update(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'edit_id' => 'required'
            ]);
            $event = Event::findOrFail($request->edit_id);
            if (!$event) {
                throw new ModelNotFoundException;
            }
            $event->name = $request->name;
            $event->update();
            return view('event.index');
        } catch (\Exception $exception) {
            Log::error($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

    public function addTheCheck($theCheckTotal, $eventActive){
        DB::beginTransaction();
        $eventActive->the_check = $theCheckTotal;
        $eventActive->update();
        DB::commit();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function eventActive()
    {
        return Event::query()->where('status', '=', Event::ACTIVE)->first();
    }
}
