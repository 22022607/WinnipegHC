<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use PDF;

class FrontController extends Controller
{
    public function index()
    {
        $upcoming_event = Event::whereDate('date', '>=', now())
                   ->orderBy('date', 'asc')
                   ->get();
                   
        $events = Event::whereDate('date', '>=', now())->first();
        // dd($upcoming_event);
        return view('front.index',compact('upcoming_event','events'));
    }
   
    public function event()
    {
        // $events=Event::get();
         $events = Event::whereDate('date', '>=', now())
                   ->orderBy('date', 'asc')
                   ->get();
        return view('front.event.index',compact('events'));
    }
    
    public function eventDetails($id)
    {
        $event_details=Event::find($id);
          
         $attendees_count=Order::where('event_id',$id)->count();
        return view('front.event.eventdetails',compact('event_details','attendees_count'));
    }
    public function create()
    {
        return view('front.member_dashboard.eventcreate');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'ticket_price' => 'nullable|numeric|min:0',
            'attendees' => 'nullable|integer|min:1',
        ]);

        // Save event
        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'duration' => $request->duration,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
            'venue' => $request->address,
            'prerequisites' => $request->prerequisites,
            'what_to_expect' => $request->what_to_expect,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'user_id'=>Auth::user()->id,
            'type'=>2
        ]);
        // dd($event);
        // Save ticket
        // if ($request->ticket_price || $request->attendees) {
          
        // }
        // dd($event->id);
        $ticket=  Ticket::create([
                 'user_id'=>Auth::user()->id,
                'event_id' => $event->id,
                'price' => $request->ticket_price ?? 0,
                'attendees' => $request->attendees,
                'early_bird_price'=>$request->early_bird_price,
                'ticket_sale_start'=>$request->ticket_sale_start,
                'ticket_sale_end'=>$request->ticket_sale_end,
                'registration_url'=>$request->registration_url,
                'platform_name'=>$request->platform_name,


            ]);
            // dd($ticket);

        return redirect()->back()->with('success', 'Event created successfully!');
    }
    public function manage()
    {
       $user_events= Event::where(['type'=>2,'user_id'=>Auth::user()->id])->get();
    //    dd($user_events);
        return view('front.member_dashboard.manage',compact('user_events'));
    }
    public function edit($id)
    {
        $event=Event::with('tickets')->find($id);
        // dd($event);
        return view('front.member_dashboard.eventedit',compact('event'));
    }
    public function update(Request $request, $id)
    {
       
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'category'       => 'required|string',
            'location'       => 'required|string',
            'address'        => 'required|string',
            'contact'        => 'required|string',
            'email'          => 'required|email',
            'date'           => 'required|date',
            'start_time'     => 'required|date_format:H:i',
            'end_time'       => 'required|date_format:H:i|after_or_equal:start_time',
            'prerequisites'  => 'required|string',
            'what_to_expect' => 'required|string',
            'max_attendees'  => 'required|integer|min:1',
            'sales_start'    => 'required|date',
            'sales_end'      => 'required|date|after_or_equal:sales_start',
        ]);

       
        $event = Event::findOrFail($id);

       
        $event->update($validated);

     
        return redirect()->route('front.event.manage')->with('success', 'Event updated successfully!');
    }
    public function delete($id)
    {
        $event = Event::with('tickets')->find($id);   

        if ($event) {
            $event->tickets()->delete();
            
            $event->delete();

            return redirect()->route('front.event.manage')->with('success', 'Event deleted!');
        } else {
            return redirect()->back()->with('error', 'Event not found!');
        }
    }
    public function view($id)
    {
        $view_event=Event::find($id);
        return view('front.member_dashboard.viewevent',compact('view_event'));
    }
    public function getTicket($id)
    {
        $event_details=Event::with('eventtickets')->find($id);
        // dd($event_details);
        return view('front.event.getticket',compact('event_details'));
    }
    public function purchasedTicket(Order $order)
    {
       
        if ($order->user_id !== Auth::user()->id) {
            abort(403, 'Unauthorized access.');
        }

        $order->load('event', 'ticket'); 
        return view('front.event.purchased-ticket', compact('order'));
    }
    public function download($id)
    {
        $order = Order::with(['event', 'ticket'])->findOrFail($id);

        $pdf = PDF::loadView('front.event.pdf', compact('order'));

        return $pdf->download('ticket-' . $order->ticket_code . '.pdf');
    }

}


