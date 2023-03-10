<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Member;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{

    public function index()
    {
        $event = (new EventController())->eventActive();
        $eventName = $event->name;
        $members = $event->member;
        $eventInactive = (new EventController())->eventInactive();
        $events = Event::all();
        return view('members.index', compact('members', 'events', 'eventInactive', 'eventName'));
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
       $memberValidated =  $request->validate([
            'name' => 'required',
            "event_id" =>'required'
        ]);
        Member::create($memberValidated);
        return redirect('/');
//        return view('members.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * @param Request $request
     * @param Member $member
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function updatePaymentStatus(Request $request, Member $member)
    {
        try {
            $request->validate([
                'edit_id' => 'required'
            ]);
            $event = $member::findOrFail($request->edit_id);

            if (!$event) {
                throw new ModelNotFoundException;
            }
            $paid = (bool)$request->paid;
            $aPiece = (bool)$request->a_piece;

            $paymentStatus = $event->payment_status;
            $paymentStatus['paid'] = $paid;
            $paymentStatus['a_piece'] = $aPiece;
            $event->payment_status = $paymentStatus;
            $event->update();
            return redirect()->route('home');
        } catch (\Exception $exception) {
            Log::error($exception);
        }
    }

    /**
     * @param Request $request
     * @param Member $member
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update(Request $request, Member $member)
    {
        try {
           $member->name = $request->name;
           $member->update();
            return redirect()->route('members.index');
        } catch (\Exception $exception) {
            Log::error($exception);
        }
    }

    /**
     * @param Member $member
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index');
    }
}
