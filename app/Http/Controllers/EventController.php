<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class EventController extends Controller
{
    public function index() {
        // return 'Events page working';
        $events = Event::all();
        // dd($events);

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
            'date'=>'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after_or_equal:start_time',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category'=>'required',
            'prerequisites'=>'required',
            'what_to_expect'=>'required',
            'category'=>'required',

        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('events'), $filename);
            // $path = $file->storeAs('events', $filename, 'public');
              $validated['image'] = 'events/' . $filename;
            // $validated['image'] = $path;
        }
        

        $validated['user_id'] = Auth::user()->id;
        $validated['type'] = 1;
        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Event added!');
    }

    public function edit($id) {
        $event=Event::find($id);
        // dd($event);
        return view('events.edit', compact('event'));
    }
    public function update(Request $request,$id) {
        $event=Event::find($id);
        // dd($event);

        $event->update($request->validate([
             'title' => 'required',
            'description' => 'required',
            'venue' => 'required',
            'total_seats' => 'required|integer',
            'host' => 'required',
            'contact' => 'required',
            // 'facebook_link' => 'nullable|url',
            // 'registration_link' =>  'nullable|url',
            'admission_fee' => 'required',
            // 'website' => 'nullable|url',
            'email' => 'required|email',
             'date'=>'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after_or_equal:start_time',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category'=>'required',
            'prerequisites'=>'required',
            'what_to_expect'=>'required',
            'category'=>'required',

        ]));
        return redirect()->route('events.index')->with('success', 'Event updated!');
    }
    public function destroy($id) {
        $event=Event::find($id);   
        if($event){

        $event->delete();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
        return redirect()->route('events.index')->with('success', 'Event deleted!');
        }else{
            dd('error');
        }
    }
}

