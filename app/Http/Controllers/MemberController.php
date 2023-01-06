<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('members.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
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
            'name' => 'required',
            "events_id"
        ]);
        $event = Member::create($request->all());
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
    public function update(Request $request, Member $member)
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }
}
