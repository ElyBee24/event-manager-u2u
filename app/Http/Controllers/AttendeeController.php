<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendee;

class AttendeeController extends Controller
{
    public function index()
    {
        $attendees = Attendee::all();

        return $attendees;
    }

    public function show($id)
    {
        $attendee = Attendee::findOrFail($id);
        
        return $attendee;
    }

    public function store(Request $request)
    {
        // $request parameters should have been validated

        return Attendee::create([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email')
        ]);
    }

    public function update(Request $request, $id)
    {
        // $request parameters should have been validated

        $attendee = Attendee::findOrFail($id);

        $attendee->update([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email')
        ]);

        return $attendee;   
    }

    public function destroy($id)
    {
        $attendee = Attendee::findOrFail($id);

        return $attendee->delete();
    }
}
