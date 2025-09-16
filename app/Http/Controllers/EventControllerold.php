<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;
 
class EventController extends Controller
{
    public function index() {
        return 'Events page working';
        $events = Event::all();
        return view('events.index', compact('events'));
    }
    public function show()
    {
        // dd($events);
        $events = Event::all();
        return view('events.index', compact('events'));
    }
    public function create()
    {
        return view('events.create');
    }
  

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'venue' => 'required',
            'total_seats' => 'required|integer',
            'host' => 'required',
            'contact' => 'required',
            'facebook_link' => 'nullable|url',
            'registration_link' =>  'nullable|url',
            'admission_fee' => 'required',
            'website' => 'nullable|url',
            'email' => 'required|email',
            'date_time_from' => 'required|date',
            'date_time_to' => 'required|date|after_or_equal:date_time_from',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Event added!');
    }

    public function edit(Event $event) {
        return view('events.edit', compact('event'));
    }
    public function update(Request $request, Event $event) {
        $event->update($request->validate([
             'title' => 'required',
            'description' => 'required',
            'venue' => 'required',
            'total_seats' => 'required|integer',
            'host' => 'required',
            'contact' => 'required',
            'facebook_link' => 'nullable|url',
            'registration_link' =>  'nullable|url',
            'admission_fee' => 'required',
            'website' => 'nullable|url',
            'email' => 'required|email',
            'date_time_from' => 'required|date',
            'date_time_to' => 'required|date|after_or_equal:date_time_from',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]));
        return redirect()->route('events.index')->with('success', 'Event updated!');
    }
    public function destroy(Event $event) {
        $event->delete();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
        return redirect()->route('events.index')->with('success', 'Event deleted!');
    }
}

