<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Attendee;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return $events;
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        
        return $event;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'string',
            'scheduled_at' => 'required|date',
            'location' => 'required|string',
            'max_attendees' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        return Event::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'scheduled_at' => $request->get('scheduled_at'),
            'location' => $request->get('location'),
            'max_attendees' => $request->get('max_attendees')
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'string',
            'scheduled_at' => 'required|date',
            'location' => 'required|string',
            'max_attendees' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $event = Event::findOrFail($id);

        $event->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'scheduled_at' => $request->get('scheduled_at'),
            'location' => $request->get('location'),
            'max_attendees' => $request->get('max_attendees')
        ]);

        return $event;   
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        return $event->delete();
    }

    public function addAttendee(Request $request, $id)
    {
        $event = Event::with('attendees')->withCount('attendees')->findOrFail($id);
        $attendee = Attendee::findOrFail($request->get('attendee_id'));

        if ($event->attendees->contains($attendee)) {
            return response()->json(['message' => 'Attendee is already part of event'], 400);
        }

        if ($event->attendees_count >= $event->max_attendees) {
            return response()->json(['message' => 'Event is full'], 400);
        }

        $event->attendees()->attach($attendee);

        return response()->json(['message' => 'Attendee added to event'], 200);
    }
}
