<?php

namespace App\Http\Controllers;

use App\Event;
use App\Subject;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('calendars.event', compact('user'));
    }

    public function ajaxClassrooms(Subject $subject, User $user)
    {
        return view('calendars.partials._ajaxClassrooms', compact('user', 'subject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $event = new Event;

        $event->title = $request->title;
        $event->subject_id = $request->subject_id;
        $event->classroom_id = $request->classroom_id;
        $event->start = new Carbon($request->date .' '.$request->start);
        $event->end = new Carbon($request->date .' '.$request->end);

        $user->events()->save($event);

        return response([
            'message' => 'A new event has been created.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
