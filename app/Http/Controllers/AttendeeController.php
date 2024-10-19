<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendee;
use Illuminate\Support\Facades\Validator;
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
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        return Attendee::create([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email')
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

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
